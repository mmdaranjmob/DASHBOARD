<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $fillable = ['key', 'value'];

    private static array $cache = [];

    public static function get(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, self::$cache)) {
            return self::$cache[$key];
        }

        $value = static::query()->where('key', $key)->value('value');
        return self::$cache[$key] = $value ?? $default;
    }

    public static function set(string $key, mixed $value): self
    {
        self::$cache[$key] = $value;
        return static::query()->updateOrCreate(['key' => $key], ['value' => (string) $value]);
    }
}
