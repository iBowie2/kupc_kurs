const orderOptions = ['Пусто', 'Замена масла', 'Ремонт двигателя', 'Замена колёс'];
const orderCosts = [0, 100, 200, 300, 400];
const orderOptionsControls = document.getElementsByClassName('order-option');
const cancelControls = document.getElementsByClassName('order-option-cancel');
const containerControls = document.getElementsByClassName('order-option-container');

for (let index = 0; index < cancelControls.length; index++) {
    const cancelControl = cancelControls[index];
    
}

for (let index = 0; index < orderOptionsControls.length; index++) {
    const orderOptionControl = orderOptionsControls[index];

    refreshControl(orderOptionControl, orderOptions);
}

function refreshControl(element, options)
{
    const oldIndex = element.selectedIndex;

    element.innerHTML = '';

    for (let optionIndex = 0; optionIndex < options.length; optionIndex++) {
        const orderOption = options[optionIndex];
        
        var optionElement = document.createElement('option');
        optionElement.value = orderOption;
        optionElement.innerHTML = orderOption;

        element.appendChild(optionElement);
    }

    element.selectedIndex = oldIndex;
}

function refreshOrderOptions(){
    var unusedOptions = orderOptions.concat([]);

    for (let index = 0; index < orderOptionsControls.length - 1; index++) {
        const orderOptionControl = orderOptionsControls[index];
        const container = containerControls[index];

        const nextOrderOptionControl = orderOptionsControls[index + 1];
        const nextContainer = containerControls[index + 1];

        if (orderOptionControl.selectedIndex < 1)
        {
            nextContainer.classList.add('hidden');
        }
        else{
            nextContainer.classList.remove('hidden');
            
            let selectedItem = orderOptionControl.options[orderOptionControl.selectedIndex].value;

            unusedOptions = unusedOptions.filter(e => e !== selectedItem);

            refreshControl(nextOrderOptionControl, unusedOptions);

            if (unusedOptions.length == 1)
            {
                nextContainer.classList.add('hidden');
            }
        }
    }
}