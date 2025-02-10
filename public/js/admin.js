(function() {
    'use strict';

    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach(e => e.addEventListener(type, listener));
        } else {
            select(el, all).addEventListener(type, listener);
        }
    };

    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener);
    };

    if (select('.toggle-sidebar-btn')) {
        on('click', '.toggle-sidebar-btn', function(e) {
            select('body').classList.toggle('toggle-sidebar');
        });
    }

    if (select('.search-bar-toggle')) {
        on('click', '.search-bar-toggle', function(e) {
            select('.search-bar').classList.toggle('search-bar-show');
        });
    }

    let navbarlinks = select('#navbar .scrollto', true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active');
            } else {
                navbarlink.classList.remove('active');
            }
        });
    };
    window.addEventListener('load', navbarlinksActive);
    onscroll(document, navbarlinksActive);

    let selectHeader = select('#header');
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add('header-scrolled');
            } else {
                selectHeader.classList.remove('header-scrolled');
            }
        };
        window.addEventListener('load', headerScrolled);
        onscroll(document, headerScrolled);
    }

    let backtotop = select('.back-to-top');
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active');
            } else {
                backtotop.classList.remove('active');
            }
        };
        window.addEventListener('load', toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /**
     * Initiate quill editors
     */
    if (select('.quill-editor-default')) {
        new Quill('.quill-editor-default', {
            theme: 'snow',
        });
    }

    if (select('.quill-editor-bubble')) {
        new Quill('.quill-editor-bubble', {
            theme: 'bubble',
        });
    }

    if (select('.quill-editor-full')) {
        new Quill('.quill-editor-full', {
            modules: {
                toolbar: [
                    [{
                        font: [],
                    }, {
                        size: [],
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        color: [],
                    },
                        {
                            background: [],
                        },
                    ],
                    [{
                        script: 'super',
                    },
                        {
                            script: 'sub',
                        },
                    ],
                    [{
                        list: 'ordered',
                    },
                        {
                            list: 'bullet',
                        },
                        {
                            indent: '-1',
                        },
                        {
                            indent: '+1',
                        },
                    ],
                    ['direction', {
                        align: [],
                    }],
                    ['link', 'image', 'video'],
                    ['clean'],
                ],
            },
            theme: 'snow',
        });
    }

    var needsValidation = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(needsValidation)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });

    const datatables = select('.datatable', true);
    datatables.forEach(datatable => {
        new simpleDatatables.DataTable(datatable);
    });

    const mainContainer = select('#main');
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function() {
                select('.echart', true).forEach(getEchart => {
                    echarts.getInstanceByDom(getEchart);
                });
            }).observe(mainContainer);
        }, 200);
    }
})();

document.querySelectorAll('.search-input').forEach((input) => {
    const clearIcon = input.nextElementSibling;

    input.addEventListener('keyup', function() {
        const searchTerm = input.value.toLowerCase();
        const tableId = input.getAttribute('data-table-id');
        const columnsToSearch = input.getAttribute('data-columns').split(',').map(Number);
        const table = document.getElementById(tableId);
        const rows = table.getElementsByTagName('tr');

        clearIcon.style.display = searchTerm ? 'inline' : 'none';

        for (let i = 1; i < rows.length; i++) {
            let isMatch = false;

            columnsToSearch.forEach((colIdx) => {
                const cell = rows[i].cells[colIdx];
                const cellText = cell ? cell.textContent.toLowerCase() : '';

                if (cellText.includes(searchTerm)) {
                    isMatch = true;
                }
            });

            rows[i].style.display = isMatch ? '' : 'none';
        }
    });

    clearIcon.addEventListener('click', function() {
        input.value = '';
        clearIcon.style.display = 'none';
        const tableId = input.getAttribute('data-table-id');
        const table = document.getElementById('table');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            rows[i].style.display = '';
        }
    });
});

// function clearSearch() {
//     const input = document.getElementById('searchInput');
//     const clearIcon = document.getElementById('clearSearch');
//
//     if (input) {
//         input.value = '';
//         clearIcon.style.display = 'none';
//
//         const tableId = input.getAttribute('data-table-id');
//         const table = document.getElementById('table');
//         const rows = table.getElementsByTagName('tr');
//
//         for (let i = 0; i < rows.length; i++) {
//             rows[i].style.display = '';
//         }
//     }
//
// }

function sortTable(colIdx) {
    const table = document.getElementById('table');
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);
    let isAsc = table.getAttribute('data-sort-dir') !== 'asc';

    const sortedRows = rows.sort((a, b) => {
        const x = a.cells[colIdx].textContent.trim().toLowerCase() || '';
        const y = b.cells[colIdx].textContent.trim().toLowerCase() || '';

        return isAsc ? x.localeCompare(y) : y.localeCompare(x);
    });

    const fragment = document.createDocumentFragment();
    sortedRows.forEach((row) => fragment.appendChild(row));
    tbody.appendChild(fragment);

    table.setAttribute('data-sort-dir', isAsc ? 'asc' : 'desc');
}
