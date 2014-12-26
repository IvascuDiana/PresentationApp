<?php
namespace Bman\DesktopBundle\Entity;

class Language {

    protected  $languageName;
    protected  $languageShortcut;

    public function __construct($languageName, $languageShortcut) {
        $this->languageName = $languageName;
        $this->languageShortcut = $languageShortcut;
    }

    /**
     * @return mixed
     */
    public function getLanguageName()
    {
        return $this->languageName;
    }

    /**
     * @param mixed $languageName
     */
    public function setLanguageName($languageName)
    {
        $this->languageName = $languageName;
    }

    /**
     * @return mixed
     */
    public function getLanguageShortcut()
    {
        return $this->languageShortcut;
    }

    /**
     * @param mixed $languageShortcut
     */
    public function setLanguageShortcut($languageShortcut)
    {
        $this->languageShortcut = $languageShortcut;
    }
} 