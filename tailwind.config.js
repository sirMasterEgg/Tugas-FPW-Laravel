module.exports = {
    content: ["./src/**/*.{html,js}"],
    theme: {
        extend: {
            backgroundImage: {
                login: "url('https://source.unsplash.com/category/stuff')",
            },
            colors: {
                charcoal: {
                    std: "#264653",
                    hov: "#1c343e",
                },
                "persian-green": {
                    std: "#2a9d8f",
                    hov: "#1f756b",
                },
                "maize-crayola": {
                    std: "#e9c46a",
                    hov: "#dda620",
                },
                "sandy-brown": {
                    std: "#f4a261",
                    hov: "#ee7311",
                },
                "burnt-sienna": {
                    std: "#e76f51",
                    hov: "#cd3f1c",
                },
            },
        },
    },
    plugins: [],
};
