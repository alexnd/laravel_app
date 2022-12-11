<?php

namespace App\Helpers;

class FlagsConfig
{
    static private $data = [];
    static private $loaded = false;

    static private function init()
    {
        if (!self::$loaded && !self::load()) {
            self::resetIniFile();
        }
    }

    static private function iniFilePath(): string
    {
        return config_path('flags.ini');
    }

    static private function iniFileDefaultPath(): string
    {
        return config_path('flags.default.ini');
    }

    static public function parseIniFile($path): array
    {
        if (file_exists(self::iniFilePath())) {
            $data = parse_ini_file($path) ?? [];
        } else {
            $data = [];
        }
        foreach ($data as $k => $v) {
            $data[$k] = boolval($v);
        }
        return $data;
    }

    static public function resetIniFile(): bool
    {
        if (file_exists(self::iniFileDefaultPath())) {
            self::$data = self::parseIniFile(self::iniFileDefaultPath());
            self::$loaded = true;
            self::save();
            return true;
        }
        return false;
    }

    static public function syncWithDefault(): array
    {
        self::init();
        $newVars = [];
        $data = self::parseIniFile(self::iniFileDefaultPath());
        foreach ($data as $k => $v) {
            if (self::exist($k)) continue;
            self::$data[$k] = boolval($v);
            $newVars[$k] = self::$data[$k];
        }
        if (count($newVars)) {
            self::save();
        }
        return $newVars;
    }

    static public function exist(string $id) :bool
    {
        return isset(self::$data[$id]);
    }

    static public function load(): bool
    {
        if (file_exists(self::iniFilePath())) {
            self::$data = self::parseIniFile(self::iniFilePath());
            $status = true;
        } else {
            $status = false;
        }
        self::$loaded = true;
        return $status;
    }

    static public function save()
    {
        self::init();
        $s = '';
        foreach (self::$data as $k => $v) {
            $s .= $k . ' = ' . intval($v) . PHP_EOL;
        }
        @file_put_contents(self::iniFilePath(), $s);
    }

    static public function get(string $id): bool
    {
        self::init();
        return self::$data[$id] ?? false;
    }

    static public function set(string $id, bool $value)
    {
        self::init();
        if (self::exist($id)) {
            self::$data[$id] = boolval($value);
        }
    }

    static public function all(): array
    {
        self::init();
        return self::$data;
    }

    static public function allClient(): array
    {
        self::init();
        $a = [];
        foreach (self::$data as $k => $v) {
            if (preg_match('/^_/', $k)) continue;
            $a[$k] = $v;
        }
        return $a;
    }
}
