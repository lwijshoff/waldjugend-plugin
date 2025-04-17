document.addEventListener('DOMContentLoaded', function () {
    const typeSelector = document.getElementById('waldjugend_type');
    const rowHorst = document.querySelector('.row-horst');
    const horstInput = document.querySelector('input[name="waldjugend_horst"]');
    const lvbInput = document.querySelector('input[name="waldjugend_lvb"]');
    const form = document.querySelector('form');

    function toggleFields() {
        const selected = typeSelector.value;

        if (selected === 'ortsgruppe') {
            rowHorst.style.display = '';
            horstInput.disabled = false;
        } else if (selected === 'landesverband') {
            rowHorst.style.display = '';
            horstInput.value = lvbInput.value;
            horstInput.disabled = true;
        }
    }

    // Sync horst whenever lvb changes AND "landesverband" is selected
    lvbInput.addEventListener('input', function () {
        if (typeSelector.value === 'landesverband') {
            horstInput.value = lvbInput.value;
        }
    });

    // Ensure horst gets submitted by enabling it before the form is submitted
    form.addEventListener('submit', function () {
        if (horstInput.disabled) {
            horstInput.disabled = false; // Enable horst for submission
        }
    });

    // Initial state
    toggleFields();

    // Toggle when typ changes
    typeSelector.addEventListener('change', toggleFields);
});