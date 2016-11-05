<?php
/**
 * Javascripts
 *
 * Register all scripts which would be used. Do not enqueue any script here.
 *
 * @package  Banhmi\Assets
 */

// Suffix.
$x = SCRIPT_DEBUG ? '.js' : '.min.js';

// Register app script.
$this->services['js']->add('app', $this->settings['baseuri'] . 'assets/js/app' . $x, [], self::VERSION, 1);

// Register theme-settings script.
$this->services['js']->add('theme-settings', $this->settings['baseuri'] . 'assets/js/theme-settings' . $x, ['jquery-core'], self::VERSION, 1);
