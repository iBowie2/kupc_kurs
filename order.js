const orderOptions = [
    {
        name: 'Пусто',
        cost: 0
    },
    {
        name: 'Замена масла',
        cost: 100
    },
    {
        name: 'Ремонт двигателя',
        cost: 5000
    },
    {
        name: 'Замена колёс',
        cost: 1000
    }
];
const orderOptionsControls = document.getElementsByClassName('order-option');
const cancelControls = document.getElementsByClassName('order-option-cancel');
const containerControls = document.getElementsByClassName('order-option-container');
const orderCostControl = document.getElementById('order-cost');

for (let index = 0; index < cancelControls.length; index++) {
    const cancelControl = cancelControls[index];

}

for (let index = 0; index < orderOptionsControls.length; index++) {
    const orderOptionControl = orderOptionsControls[index];

    refreshControl(orderOptionControl, orderOptions);
}

function refreshControl(element, options) {
    const oldIndex = element.selectedIndex;

    element.innerHTML = '';

    for (let optionIndex = 0; optionIndex < options.length; optionIndex++) {
        const orderOption = options[optionIndex];

        var optionElement = document.createElement('option');
        optionElement.value = orderOption.name;
        optionElement.setAttribute('data-cost', orderOption.cost);
        optionElement.innerHTML = orderOption.name;

        element.appendChild(optionElement);
    }

    element.selectedIndex = oldIndex;
}

function refreshOrderOptions() {
    var unusedOptions = orderOptions.concat([]);
    var totalCost = 0.0;

    for (let index = 0; index < orderOptionsControls.length - 1; index++) {
        const orderOptionControl = orderOptionsControls[index];
        const container = containerControls[index];

        const nextOrderOptionControl = orderOptionsControls[index + 1];
        const nextContainer = containerControls[index + 1];

        if (orderOptionControl.selectedIndex < 1) {
            nextContainer.classList.add('hidden');
        }
        else {
            nextContainer.classList.remove('hidden');

            let selectedItem = orderOptionControl.options[orderOptionControl.selectedIndex];
            let selectedValue = selectedItem.value;
            let selectedCost = selectedItem.getAttribute('data-cost');

            if (!isNaN(selectedCost)) {
                totalCost += Number(selectedCost);
            }

            unusedOptions = unusedOptions.filter(e => e.name !== selectedValue);

            refreshControl(nextOrderOptionControl, unusedOptions);

            if (unusedOptions.length == 1) {
                nextContainer.classList.add('hidden');
            }
        }
    }

    orderCostControl.innerHTML = totalCost + " рублей";
}