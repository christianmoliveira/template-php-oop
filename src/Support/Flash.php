<?php

declare(strict_types=1);

namespace App\Support;

class Flash
{
    private const FLASH = 'FLASH_MESSAGES';

    /**
     * Create a flash message
     */
    public static function create_flash_message(string $name, string $message, string $type): void
    {
        // remove existing message with the name
        if (isset($_SESSION[self::FLASH][$name])) {
            unset($_SESSION[self::FLASH][$name]);
        }
        // add the message to the session
        $_SESSION[self::FLASH][$name] = ['message' => $message, 'type' => $type];
    }


    /**
     * Format a flash message
     *
     * @param array $flash_message
     * @return string
     */
    public static function format_flash_message(array $flash_message): string
    {
        return sprintf(
            '<div class="alert alert-%s alert-dismissible fade show" role="alert">
                      %s
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>',
            $flash_message['type'],
            $flash_message['message']
        );
    }

    /**
     * Display a flash message
     */
    public static function display_flash_message(string $name): void
    {
        if (!isset($_SESSION[self::FLASH][$name])) {
            return;
        }

        // get message from the session
        $flash_message = $_SESSION[self::FLASH][$name];

        // delete the flash message
        unset($_SESSION[self::FLASH][$name]);

        // display the flash message
        echo self::format_flash_message($flash_message);
    }

    /**
     * Display all flash messages
     */
    public static function display_all_flash_messages(): void
    {
        if (!isset($_SESSION[self::FLASH])) {
            return;
        }

        // get flash messages
        $flash_messages = $_SESSION[self::FLASH];

        // remove all the flash messages
        unset($_SESSION[self::FLASH]);

        // show all flash messages
        foreach ($flash_messages as $flash_message) {
            echo self::format_flash_message($flash_message);
        }
    }

    /**
     * Flash a message
     *
     * @param string $type (error, warning, info, success)
     */
    public static function flash(string $name = '', string $message = '', string $type = ''): void
    {
        if ($name !== '' && $message !== '' && $type !== '') {
            // create a flash message
            self::create_flash_message($name, $message, $type);
        } elseif ($name !== '' && $message === '' && $type === '') {
            // display a flash message
            self::display_flash_message($name);
        } elseif ($name === '' && $message === '' && $type === '') {
            // display all flash message
            self::display_all_flash_messages();
        }
    }
}
