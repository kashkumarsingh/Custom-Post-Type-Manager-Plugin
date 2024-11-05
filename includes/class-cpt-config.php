<?php

namespace Custom_Post_Types_Manager;

/**
 * Handles the default and custom configurations for custom post types.
 */
final class CPT_Config
{
    private array $config;

    // Define default config as a constant
    private const DEFAULT_CONFIG = [
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'show_in_rest' => true,
        'hierarchical' => false,
        'menu_position' => 5,
    ];

    /**
     * Constructor initializes default configuration settings.
     */
    public function __construct()
    {
        $this->config = self::DEFAULT_CONFIG;
    }

    /**
     * Merges and validates custom configuration settings with defaults.
     *
     * @param array $customConfig Custom configuration array.
     */
    public function applyCustomConfig(array $customConfig): void
    {
        $validatedConfig = $this->validateConfig($customConfig);
        $this->config = array_merge($this->config, $validatedConfig);
    }

    /**
     * Validates and sanitizes the custom configuration array.
     *
     * @param array $config The configuration array to validate.
     * @return array The sanitized configuration array.
     */
    private function validateConfig(array $config): array
    {
        foreach ($config as $key => $value) {
            if (isset($this->config[$key])) {
                if (is_bool($this->config[$key]) && !is_bool($value)) {
                    throw new \InvalidArgumentException("The \"$key\" key must be a boolean.");
                }
                if (is_array($this->config[$key]) && !is_array($value)) {
                    throw new \InvalidArgumentException("The \"$key\" key must be an array.");
                }
            }
        }
        return array_map('sanitize_text_field', $config);
    }

    /**
     * Retrieves the full configuration array.
     *
     * @return array Configuration array.
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Retrieves a specific configuration value.
     *
     * @param string $key Configuration key.
     * @return mixed|null Configuration value or null if key doesn't exist.
     */
    public function getConfigValue(string $key)
    {
        return $this->config[$key] ?? null;
    }
}
