document.addEventListener('DOMContentLoaded', () => {
    const buttonIds = aT;
    const tableIds = rT;

    const buttons = buttonIds.map(id => document.getElementById(id));
    const tables = tableIds.map(id => document.getElementById(id));

    const hideAllTables = () => {
        tables.forEach(table => table.classList.add('d-none'));
    };

    const toggleTable = (index) => {
        const table = tables[index];
        const button = buttons[index];

        if (table.classList.contains('d-none')) {
            hideAllTables();
            table.classList.remove('d-none');
            buttons.forEach(btn => btn.disabled = true);
            button.disabled = false;
        } else {
            table.classList.add('d-none');
            button.disabled = false;
            buttons.forEach(btn => btn.disabled = false);
        }
    };

    buttons.forEach((button, index) => {
        button.addEventListener('click', () => toggleTable(index));
    });
});
