document.addEventListener('DOMContentLoaded', function () {
    const roomOptions = document.querySelectorAll('.room-option');
    roomOptions.forEach(option => {
        option.addEventListener('click', function () {
            if (!option.classList.contains('occupied')) {
                document.getElementById('roomNumber').value = option.getAttribute('data-room-number');
                roomOptions.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
            }
        });
    });

    const operationCheckbox = document.getElementById('operation');
    const operationFieldsContainer = document.getElementById('operationFieldsContainer');
    const operationTimeContainer = document.getElementById('operationTimeContainer');
    
    operationCheckbox.addEventListener('change', function() {
        if (operationCheckbox.checked) {
            operationFieldsContainer.style.display = 'block';
            operationTimeContainer.style.display = 'block';
        } else {
            operationFieldsContainer.style.display = 'none';
        }
    });
});

function toggleOperationFields() {
    const operationFieldsContainer = document.getElementById('operationFieldsContainer');
    const operationCheckbox = document.getElementById('operation');
    if (operationCheckbox.checked) {
        operationFieldsContainer.style.display = 'block';
        operationTimeContainer.style.display = 'block';
    } else {
        operationFieldsContainer.style.display = 'none';
    }
}
