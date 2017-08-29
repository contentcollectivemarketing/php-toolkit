<?php

namespace Toolkit\Utility;

/**
 * Class Inflector.
 *
 * Pluralize & Singularize implementation are borrowed from CakePHP with some modifications.
 *
 * @package Toolkit\Utility
 */
class Inflector
{
    /**
     * Plural inflector rules.
     *
     * @var array
     * @see http://english-zone.com/spelling/plurals.html
     */
    private static $plural = [
        '/([nrlm]ese|deer|fish|sheep|measles|ois|pox|media)$/i'                  => '\1',
        '/^(sea[- ]bass)$/i'                                                     => '\1',
        '/(m)ove$/i'                                                             => '\1oves',
        '/(f)oot$/i'                                                             => '\1eet',
        '/(h)uman$/i'                                                            => '\1umans',
        '/(s)tatus$/i'                                                           => '\1tatuses',
        '/(s)taff$/i'                                                            => '\1taff',
        '/(t)ooth$/i'                                                            => '\1eeth',
        '/(quiz)$/i'                                                             => '\1zes',
        '/^(ox)$/i'                                                              => '\1\2en',
        '/([m|l])ouse$/i'                                                        => '\1ice',
        '/(matr|vert|ind)(ix|ex)$/i'                                             => '\1ices',
        '/(x|ch|ss|sh)$/i'                                                       => '\1es',
        '/([^aeiouy]|qu)y$/i'                                                    => '\1ies',
        '/(hive)$/i'                                                             => '\1s',
        '/(?:([^f])fe|([lr])f)$/i'                                               => '\1\2ves',
        '/sis$/i'                                                                => 'ses',
        '/([ti])um$/i'                                                           => '\1a',
        '/(p)erson$/i'                                                           => '\1eople',
        '/(m)an$/i'                                                              => '\1en',
        '/(c)hild$/i'                                                            => '\1hildren',
        '/(buffal|tomat|potat|ech|her|vet)o$/i'                                  => '\1oes',
        '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)us$/i' => '\1i',
        '/us$/i'                                                                 => 'uses',
        '/(alias)$/i'                                                            => '\1es',
        '/(ax|cris|test)is$/i'                                                   => '\1es',
        '/(currenc)y$/'                                                          => '\1ies',
        '/s$/'                                                                   => 's',
        '/^$/'                                                                   => '',
        '/$/'                                                                    => 's',
    ];

    /**
     * Singular inflector rules.
     *
     * @var array
     */
    private static $singular = [
        '/([nrlm]ese|deer|fish|sheep|measles|ois|pox|media|ss)$/i'                => '\1',
        '/^(sea[- ]bass)$/i'                                                      => '\1',
        '/(s)tatuses$/i'                                                          => '\1tatus',
        '/(f)eet$/i'                                                              => '\1oot',
        '/(t)eeth$/i'                                                             => '\1ooth',
        '/^(.*)(menu)s$/i'                                                        => '\1\2',
        '/(quiz)zes$/i'                                                           => '\\1',
        '/(matr)ices$/i'                                                          => '\1ix',
        '/(vert|ind)ices$/i'                                                      => '\1ex',
        '/^(ox)en/i'                                                              => '\1',
        '/(alias)(es)*$/i'                                                        => '\1',
        '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$/i' => '\1us',
        '/([ftw]ax)es/i'                                                          => '\1',
        '/(cris|ax|test)es$/i'                                                    => '\1is',
        '/(shoe|slave)s$/i'                                                       => '\1',
        '/(o)es$/i'                                                               => '\1',
        '/ouses$/'                                                                => 'ouse',
        '/([^a])uses$/'                                                           => '\1us',
        '/([m|l])ice$/i'                                                          => '\1ouse',
        '/(x|ch|ss|sh)es$/i'                                                      => '\1',
        '/(m)ovies$/i'                                                            => '\1\2ovie',
        '/(s)eries$/i'                                                            => '\1\2eries',
        '/([^aeiouy]|qu)ies$/i'                                                   => '\1y',
        '/([lr])ves$/i'                                                           => '\1f',
        '/(tive)s$/i'                                                             => '\1',
        '/(hive)s$/i'                                                             => '\1',
        '/(drive)s$/i'                                                            => '\1',
        '/([^fo])ves$/i'                                                          => '\1fe',
        '/(^analy)ses$/i'                                                         => '\1sis',
        '/(analy|diagno|^ba|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i'             => '\1\2sis',
        '/([ti])a$/i'                                                             => '\1um',
        '/(p)eople$/i'                                                            => '\1\2erson',
        '/(m)en$/i'                                                               => '\1an',
        '/(c)hildren$/i'                                                          => '\1\2hild',
        '/(n)ews$/i'                                                              => '\1\2ews',
        '/(n)etherlands$/i'                                                       => '\1\2etherlands',
        '/eaus$/'                                                                 => 'eau',
        '/(currenc)ies$/'                                                         => '\1y',
        '/^(.*us)$/'                                                              => '\\1',
        '/s$/i'                                                                   => '',
    ];

    /**
     * Irregular rules.
     *
     * @var array
     */
    private static $irregular = [
        'atlas'        => 'atlases',
        'axe'          => 'axes',
        'beef'         => 'beefs',
        'brother'      => 'brothers',
        'cafe'         => 'cafes',
        'child'        => 'children',
        'cookie'       => 'cookies',
        'corpus'       => 'corpuses',
        'cow'          => 'cows',
        'criterion'    => 'criteria',
        'curriculum'   => 'curricula',
        'curve'        => 'curves',
        'demo'         => 'demos',
        'domino'       => 'dominoes',
        'echo'         => 'echoes',
        'foe'          => 'foes',
        'foot'         => 'feet',
        'fungus'       => 'fungi',
        'ganglion'     => 'ganglions',
        'genie'        => 'genies',
        'genus'        => 'genera',
        'graffito'     => 'graffiti',
        'hippopotamus' => 'hippopotami',
        'hoof'         => 'hoofs',
        'human'        => 'humans',
        'iris'         => 'irises',
        'larva'        => 'larvae',
        'leaf'         => 'leaves',
        'loaf'         => 'loaves',
        'man'          => 'men',
        'money'        => 'monies',
        'mongoose'     => 'mongooses',
        'move'         => 'moves',
        'mythos'       => 'mythoi',
        'niche'        => 'niches',
        'numen'        => 'numina',
        'occiput'      => 'occiputs',
        'octopus'      => 'octopuses',
        'opus'         => 'opuses',
        'ox'           => 'oxen',
        'pasta'        => 'pasta',
        'penis'        => 'penises',
        'sex'          => 'sexes',
        'soliloquy'    => 'soliloquies',
        'testis'       => 'testes',
        'trilby'       => 'trilbys',
        'turf'         => 'turfs',
        'wave'         => 'waves',
        'Amoyese'      => 'Amoyese',
        'bison'        => 'bison',
        'Borghese'     => 'Borghese',
        'bream'        => 'bream',
        'breeches'     => 'breeches',
        'britches'     => 'britches',
        'buffalo'      => 'buffalo',
        'cantus'       => 'cantus',
        'carp'         => 'carp',
        'chassis'      => 'chassis',
        'clippers'     => 'clippers',
        'cod'          => 'cod',
        'coitus'       => 'coitus',
        'Congoese'     => 'Congoese',
        'contretemps'  => 'contretemps',
        'corps'        => 'corps',
        'debris'       => 'debris',
        'diabetes'     => 'diabetes',
        'djinn'        => 'djinn',
        'eland'        => 'eland',
        'elk'          => 'elk',
        'equipment'    => 'equipment',
        'Faroese'      => 'Faroese',
        'flounder'     => 'flounder',
        'Foochowese'   => 'Foochowese',
        'gallows'      => 'gallows',
        'Genevese'     => 'Genevese',
        'Genoese'      => 'Genoese',
        'Gilbertese'   => 'Gilbertese',
        'graffiti'     => 'graffiti',
        'headquarters' => 'headquarters',
        'herpes'       => 'herpes',
        'hijinks'      => 'hijinks',
        'Hottentotese' => 'Hottentotese',
        'information'  => 'information',
        'innings'      => 'innings',
        'jackanapes'   => 'jackanapes',
        'Kiplingese'   => 'Kiplingese',
        'Kongoese'     => 'Kongoese',
        'Lucchese'     => 'Lucchese',
        'mackerel'     => 'mackerel',
        'Maltese'      => 'Maltese',
        'mews'         => 'mews',
        'moose'        => 'moose',
        'mumps'        => 'mumps',
        'Nankingese'   => 'Nankingese',
        'news'         => 'news',
        'nexus'        => 'nexus',
        'Niasese'      => 'Niasese',
        'Pekingese'    => 'Pekingese',
        'Piedmontese'  => 'Piedmontese',
        'pincers'      => 'pincers',
        'Pistoiese'    => 'Pistoiese',
        'pliers'       => 'pliers',
        'Portuguese'   => 'Portuguese',
        'proceedings'  => 'proceedings',
        'rabies'       => 'rabies',
        'rice'         => 'rice',
        'rhinoceros'   => 'rhinoceros',
        'salmon'       => 'salmon',
        'Sarawakese'   => 'Sarawakese',
        'scissors'     => 'scissors',
        'series'       => 'series',
        'Shavese'      => 'Shavese',
        'shears'       => 'shears',
        'siemens'      => 'siemens',
        'sieve'        => 'sieves',
        'species'      => 'species',
        'swine'        => 'swine',
        'sex'          => 'sexes',
        'soliloquy'    => 'soliloquies',
        'son-in-law'   => 'sons-in-law',
        'syllabus'     => 'syllabi',
        'testes'       => 'testes',
        'trousers'     => 'trousers',
        'trout'        => 'trout',
        'tuna'         => 'tuna',
        'testis'       => 'testes',
        'thief'        => 'thieves',
        'tooth'        => 'teeth',
        'tornado'      => 'tornadoes',
        'trilby'       => 'trilbys',
        'turf'         => 'turfs',
        'Vermontese'   => 'Vermontese',
        'volcano'      => 'volcanoes',
        'Wenchowese'   => 'Wenchowese',
        'whiting'      => 'whiting',
        'wildebeest'   => 'wildebeest',
        'Yengeese'     => 'Yengeese',
    ];

    /**
     * Returns the singular form of a word.
     *
     * @param string $word
     * @return string
     */
    public static function pluralize(string $word) : string
    {
        if (isset(self::$irregular[$word])) {
            return self::$irregular[$word];
        }
        $word = self::replace(self::$plural, $word);

        return $word;
    }

    /**
     * Returns the singular form of a word.
     *
     * @param string $word
     * @return false|int|mixed|string
     */
    public static function singularize(string $word)
    {
        $result = array_search($word, self::$irregular, true);

        if ($result !== false) {
            return $result;
        }
        $word = self::replace(self::$singular, $word);

        return $word;
    }

    /**
     * Takes multiple words separated by spaces or underscores and camelizes them.
     *
     * @param string $string
     * @param string $delimiter
     * @return string
     */
    public static function camelize(string $string, string $delimiter = '_') : string
    {
        return str_replace(' ', '', self::humanize($string, $delimiter));
    }

    /**
     * Takes multiple words separated by the delimiter and changes them to spaces.
     *
     * @param string $string
     * @param string $delimiter
     * @return string
     */
    public static function humanize(string $string, string $delimiter = '_') : string
    {
        $array = explode(' ', str_replace($delimiter, ' ', $string));
        foreach ($array as &$word) {
            $word = mb_strtoupper(mb_substr($word, 0, 1)) . mb_substr($word, 1);
        }

        return implode(' ', $array);
    }

    /**
     * Converts a word into the format for a model class name,
     * converts 'table_name' to 'TableName'.
     *
     * @param string $word
     * @return string
     */
    public static function classify(string $word) : string
    {
        return self::camelize(self::singularize($word));
    }

    /**
     * Converts any "CameCased" into an "lower_case_delimited_string"
     *
     * @param string $string
     * @param string $delimiter
     * @return string
     */
    public static function delimit(string $string, string $delimiter = '_') : string
    {
        return mb_strtolower(preg_replace('/(?<=\\w)([A-Z])/', $delimiter . '\\1', $string));
    }

    /**
     * Converts any "CamelCasedString" into an "underscored_string".
     *
     * @param string $string
     * @return string
     */
    public static function underscore(string $string) : string
    {
        return self::delimit(str_replace('-', '_', $string), '_');
    }

    /**
     * Converts any "CamelCasedString" into as an "dashed-string".
     *
     * @param string $string
     * @return string
     */
    public static function dasherize(string $string) : string
    {
        return self::delimit(str_replace('_', '-', $string), '-');
    }

    /**
     * Converts a class name to its table name (pluralized) naming conventions.
     *
     * @param string $table
     * @return string
     */
    public static function tableize(string $table) : string
    {
        return self::pluralize(self::underscore($table));
    }

    /**
     * Returns camelBacked version of an underscored string.
     *
     * @param string $string
     * @return string
     */
    public static function variable(string $string) : string
    {
        $variable = self::camelize(self::underscore($string));

        return strtolower($variable[0]) . substr($string, 1);
    }

    /**
     * Convert number to its ordinal english form.
     *
     * @param int    $number
     * @param string $delimiter
     * @return string
     */
    public static function ordinalize(int $number, string $delimiter = '') : string
    {
        if (in_array($number % 100, range(11, 13), true)) {
            return $number . $delimiter . 'th';
        }

        switch ($number % 10) {
            case 1:
                return $number . $delimiter . 'st';
            case 2:
                return $number . $delimiter . 'nd';
            case 3:
                return $number . $delimiter . 'rd';
            case 4:
                return $number . $delimiter . 'th';
        }
    }

    /**
     * @param array  $array
     * @param string $word
     * @return string
     */
    private static function replace(array $array, string $word) : string
    {
        foreach ($array as $pattern => $replacement) {
            if (preg_match($pattern, $word)) {
                $word = preg_replace($pattern, $replacement, $word);
                break;
            }
        }

        return $word;
    }
}
