import flowbite from 'flowbite/plugin'

export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {},
    },
    plugins: [flowbite],
}

