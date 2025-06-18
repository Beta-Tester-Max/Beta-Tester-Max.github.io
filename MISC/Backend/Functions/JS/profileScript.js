document.addEventListener('DOMContentLoaded', () => {
    const buttonIds = aB;
    const tableIds = aTT;
    const titleIds = aT;

    const buttons = buttonIds.map(id => document.getElementById(id));
    const tables = tableIds.map(id => document.getElementById(id));
    const titles = titleIds.map(id => document.getElementById(id));

    const hideAllTables = () => {
        tables.forEach(table => table.classList.add('d-none'));
        titles.forEach(title => title.classList.add('d-none'));
    };

    const toggleTable = (index) => {
        const table = tables[index];
        const title = titles[index];
        const button = buttons[index];

        if (table.classList.contains('d-none')) {
            hideAllTables();
            table.classList.remove('d-none');
            title.classList.remove('d-none');
            buttons.forEach(btn => btn.disabled = true);
            button.disabled = false;
        } else {
            table.classList.add('d-none');
            title.classList.add('d-none');
            button.disabled = false;
            buttons.forEach(btn => btn.disabled = false);
        }
    };

    buttons.forEach((button, index) => {
        button.addEventListener('click', () => toggleTable(index));
    });
});
