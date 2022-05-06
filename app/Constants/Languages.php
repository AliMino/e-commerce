<?php

namespace App\Constants;

/**
 * Languages Constants.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class Languages {

    public const DEFAULT_LANG_NAME = self::ENGLISH_NAME;
    public const DEFAULT_LANG_CODE = self::ENGLISH_CODE;

    public const ENGLISH_NAME      = 'English';
    public const FRENCH_NAME       = 'French';
    public const ITALIAN_NAME      = 'Italian';

    public const ENGLISH_CODE      = 'en';
    public const FRENCH_CODE       = 'fr';
    public const ITALIAN_CODE      = 'it';

    public const ALL = [
        self::ENGLISH_CODE  => self::ENGLISH_NAME,
        self::FRENCH_CODE   => self::FRENCH_NAME,
        self::ITALIAN_CODE  => self::ITALIAN_NAME
    ];
}
