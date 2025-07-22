document.addEventListener("DOMContentLoaded", function () {
    const selected = document.getElementById("selected-option");
    const options = document.getElementById("options-list");
    const hiddenInput = document.getElementById("language-select");
    const optionItems = options.querySelectorAll(".option");

    function log(msg) {
        console.log("[Translate Debug]", msg);
    }

    function triggerGoogleTranslate(lang) {
        log(`Trying to translate to: ${lang}`);

        const interval = setInterval(() => {
            const googleCombo = document.querySelector(".goog-te-combo");

            if (googleCombo) {
                log("Google combo found. Triggering change...");

                googleCombo.value = lang;
                googleCombo.dispatchEvent(new Event("change"));

                clearInterval(interval);
            } else {
                log("Waiting for .goog-te-combo...");
            }
        }, 300);

        setTimeout(() => {
            clearInterval(interval);
            log("Stopped waiting after 5 seconds.");
        }, 5000);
    }

    // Show/hide dropdown
    selected.addEventListener("click", (e) => {
        e.stopPropagation();
        options.style.display = options.style.display === "block" ? "none" : "block";
    });

    // Click outside closes dropdown
    document.addEventListener("click", (e) => {
        if (!e.target.closest(".custom-select-wrapper")) {
            options.style.display = "none";
        }
    });

    // Language selection
    optionItems.forEach(option => {
        option.addEventListener("click", () => {
            const lang = option.getAttribute("data-lang") || "en";

            log(`Language selected: ${lang}`);

            selected.innerHTML = option.innerHTML;
            hiddenInput.value = lang;
            options.style.display = "none";

            triggerGoogleTranslate(lang);
        });
    });

    // Optional: hide Google widget
    setTimeout(() => {
        const widget = document.getElementById("google_translate_element");
        if (widget) {
            widget.style.display = "none";
            log("Google translate widget hidden.");
        }
    }, 5000);
});
