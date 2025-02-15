import $ from 'jquery';

window.$ = window.jQuery = $;

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import * as bootstrap from 'bootstrap';
import 'animate.css';
import AOS from 'aos';
import 'aos/dist/aos.css';
import 'aos/dist/aos.js';
import ApexCharts from 'apexcharts';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'boxicons';
import Chart from 'chart.js/auto';
import 'jquery.easing';
import 'summernote/dist/summernote-bs4.js';
import * as echarts from 'echarts';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import { Glightbox } from './glightbox';
import { initIsotope } from './isotope';
import PureCounter from '@srexi/purecounterjs';
import { DataTable } from 'simple-datatables';
import 'simple-datatables/dist/style.css'
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Swal = Swal;

AOS.init({
    duration: 1000,
    easing: 'ease-in-out',
    once: true,
    mirror: false,
});

new PureCounter();

window.bootstrap = bootstrap;
window.ApexCharts = ApexCharts;
window.Chart = Chart;
window.echarts = echarts;
// window.Swal = Swal;
window.FullCalendar = {
    Calendar,
    dayGridPlugin,
    interactionPlugin,
};

document.addEventListener('DOMContentLoaded', () => {
    Glightbox();
    initIsotope();

    const table = document.querySelector('#myTable');
    if (table) {
        new DataTable(table)
    }
});
