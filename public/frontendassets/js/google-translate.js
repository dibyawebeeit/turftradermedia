function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,fr,hi,es',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
}

document.addEventListener("DOMContentLoaded", function () {
    const selected = document.getElementById("selected-option");
    const options = document.getElementById("options-list");
    const hiddenInput = document.getElementById("language-select");
    const optionItems = options.querySelectorAll(".option");

    let attempts = 0;

    function triggerGoogleTranslate(lang) {
        const googleCombo = document.querySelector(".goog-te-combo");
        if (googleCombo) {
            googleCombo.value = lang;
            googleCombo.dispatchEvent(new Event("change"));
        } else if (attempts < 20) {
            attempts++;
            setTimeout(() => triggerGoogleTranslate(lang), 500);
        } else {
            console.error("Google Translate dropdown not loaded.");
        }
    }

    // Toggle dropdown
    selected.addEventListener("click", (e) => {
        e.stopPropagation(); // Prevent click from bubbling
        options.style.display = options.style.display === "block" ? "none" : "block";
    });

    // Close dropdown if clicked outside
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".custom-select-wrapper")) {
            options.style.display = "none";
        }
    });

    // Handle language option click
    optionItems.forEach(option => {
        option.addEventListener("click", () => {
            const lang = option.getAttribute("data-lang") || option.getAttribute("data-value")?.split("|")[1] || "en";

            selected.innerHTML = option.innerHTML;
            hiddenInput.value = lang;
            options.style.display = "none";

            triggerGoogleTranslate(lang);
        });
    });
});
