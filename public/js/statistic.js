document.addEventListener('DOMContentLoaded', () => {
    const { makestaCounts, lakmudCounts, lakutCounts, latinpelCounts } = window.chartData;
    const { makesta, lakmud, lakut, latinpel } = window.chartLables;

    const years = ['2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025', '2026'];

    const chart = new ApexCharts(document.querySelector('#reportsChart'), {
        series: [
            { name: makesta, data: years.map((year) => makestaCounts[year] || 0) },
            { name: lakmud, data: years.map((year) => lakmudCounts[year] || 0) },
            { name: lakut, data: years.map((year) => lakutCounts[year] || 0) },
            { name: latinpel, data: years.map((year) => latinpelCounts[year] || 0) },
        ],
        chart: { height: 350, type: 'area', toolbar: { show: false } },
        markers: { size: 4 },
        colors: ['#5CB338', '#ECE852', '#FFC145', '#FB4141'],
        fill: {
            type: 'gradient',
            gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0.4, stops: [0, 90, 100] },
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        xaxis: { type: 'datetime', categories: years },
        tooltip: { x: { format: 'yyyy' } },
        legend: { offsetY: 20, height: 52 },
    });

    chart.render();

    document.querySelectorAll('.dropdown-btn').forEach((button) => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();
            let dropdownMenu = button.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        });
    });

    document.addEventListener('click', (event) => {
        document.querySelectorAll('.dropdown-menu').forEach((menu) => {
            if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                menu.classList.remove('show');
            }
        });
    });

    document.querySelectorAll('.dropdown-item').forEach((item) => {
        item.addEventListener('click', (event) => {
            event.preventDefault();

            let filterValue = event.target.getAttribute('data-filter');
            let dropdown = event.target.closest('.dropdown');
            let dropdownButton = dropdown?.querySelector('.dropdown-btn span');
            let dropdownMenu = dropdown?.querySelector('.dropdown-menu');

            if (!dropdownMenu) return;

            if (dropdownButton) {
                dropdownButton.textContent = event.target.textContent;
            }

            dropdown.querySelectorAll('.dropdown-item').forEach((i) => i.classList.remove('active'));
            event.target.classList.add('active');

            dropdownMenu.classList.remove('show');

            let targetType = dropdown.getAttribute('data-target');
            if (targetType === 'cadre') {
                filterCadres(filterValue);
            } else if (targetType === 'news') {
                filterNews(filterValue);
            }
        });
    });

    function filterCadres(filter) {
        const now = new Date();
        let filteredYears = [];

        switch (filter) {
            case 'today':
            case 'month':
                filteredYears = [now.getFullYear().toString()];
                break;
            case 'year':
                filteredYears = years.filter((year) => parseInt(year) >= now.getFullYear() - 4);
                break;
            default:
                filteredYears = years;
                break;
        }

        chart.updateOptions({
            xaxis: { categories: filteredYears },
            series: [
                { name: makesta, data: filteredYears.map((year) => makestaCounts[year] || 0) },
                { name: lakmud, data: filteredYears.map((year) => lakmudCounts[year] || 0) },
                { name: lakut, data: filteredYears.map((year) => lakutCounts[year] || 0) },
                { name: latinpel, data: filteredYears.map((year) => latinpelCounts[year] || 0) },
            ],
        });
    }

    function filterNews(filter) {
        let rows = document.querySelectorAll('#newsTable tr');

        rows.forEach((row) => {
            let dateText = row.getAttribute('data-updated');
            let show = true;

            switch (filter) {
                case 'today':
                    let today = new Date().toISOString().split('T')[0];
                    show = dateText === today;
                    break;
                case 'month':
                    let month = new Date().toISOString().slice(0, 7);
                    show = dateText.startsWith(month);
                    break;
                case 'year':
                    let year = new Date().getFullYear().toString();
                    show = dateText.startsWith(year);
                    break;
                default:
                    show = true;
            }

            row.style.display = show ? '' : 'none';
        });
    }

    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    window.addEventListener('scroll', () => {
        const buttonRect = dropdownButton.getBoundingClientRect();
        if (buttonRect.bottom + dropdownMenu.offsetHeight > window.innerHeight) {
            dropdownMenu.classList.add('dropup');
        } else {
            dropdownMenu.classList.remove('dropup');
        }
    });
});
