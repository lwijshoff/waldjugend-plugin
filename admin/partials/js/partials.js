/* 
  * Written by Leonard Wijshoff in 2025
  * 
  * This script is part of the Waldjugend Plugin for WordPress,
  * Handles the display and functionality of the Waldjugend admin page.
*/

document.addEventListener('DOMContentLoaded', function () {
    const typeSelector = document.getElementById('waldjugend_type');
    const rowgroup = document.querySelector('.row-group');
    const groupInput = document.querySelector('input[name="waldjugend_group"]');
    const associationInput = document.querySelector('input[name="waldjugend_association"]');
    const form = document.querySelector('form');

    function toggleFields() {
        const selected = typeSelector.value;

        if (selected === 'group') {
            rowgroup.style.display = '';
            groupInput.disabled = false;
        } else if (selected === 'association') {
            rowgroup.style.display = '';
            groupInput.value = associationInput.value;
            groupInput.disabled = true;
        }
    }

    // Sync group whenever association changes AND "association" is selected
    associationInput.addEventListener('input', function () {
        if (typeSelector.value === 'association') {
            groupInput.value = associationInput.value;
        }
    });

    // Ensure group gets submitted by enabling it before the form is submitted
    form.addEventListener('submit', function () {
        if (groupInput.disabled) {
            groupInput.disabled = false; // Enable group for submission
        }
    });

    // Initial state
    toggleFields();

    // Toggle when typ changes
    typeSelector.addEventListener('change', toggleFields);
});