const preset= require('./vendor/filament/filament/tailwind.config.preset')
preset.plugins = []

module.exports = {
    presets: [preset],
    content: [
        './src/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    corePlugins: {
        preflight: false,
    },
}
