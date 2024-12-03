// document.addEventListener("toast", (event) => {
//     window.toast = function (message, options = {}) {
//         let description = "";
//         let type = "default";
//         let position = "bottom-right";
//         let html = "";
//         if (typeof options.description != "undefined")
//             description = options.description;
//         if (typeof options.type != "undefined") type = options.type;
//         if (typeof options.position != "undefined") position = options.position;
//         if (typeof options.html != "undefined") html = options.html;

//         window.dispatchEvent(
//             new CustomEvent("toast-show", {
//                 detail: {
//                     type: type,
//                     message: message,
//                     description: description,
//                     position: position,
//                     html: html,
//                 },
//             })
//         );
//     };
// });

// document.addEventListener("toast2", (event) => {
    window.toast = function (message, options = {}) {
        let description = "";
        let type = "default";
        let position = "bottom-right";
        let html = "";
        if (typeof options.description != "undefined")
            description = options.description;
        if (typeof options.type != "undefined") type = options.type;
        if (typeof options.position != "undefined") position = options.position;
        if (typeof options.html != "undefined") html = options.html;

        window.dispatchEvent(
            new CustomEvent("toast-show", {
                detail: {
                    type: type,
                    message: message,
                    description: description,
                    position: position,
                    html: html,
                },
            })
        );
    };
// });
