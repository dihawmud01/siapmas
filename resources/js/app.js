import $ from 'jquery';
window.$ = window.jQuery = $;

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import * as bootstrap from 'bootstrap';
import 'animate.css';
import AOS from 'aos';
import 'aos/dist/aos.css';
import ApexCharts from 'apexcharts';
import 'bootstrap-icons/font/bootstrap-icons.css';
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
import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/silver';
import 'tinymce/icons/default';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/plugins/code';
import 'tinymce/plugins/table';

AOS.init({
    duration: 1000,
    easing: 'ease-in-out',
    once: true,
    mirror: false,
});

new PureCounter();
new Swiper('.quote-details-slider', {
    modules: [Pagination, Autoplay],
    speed: 400,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
    },
});

const select = (el, all = false) => all ? document.querySelectorAll(el) : document.querySelector(el);

(async () => {
    const Waypoint = (await import('waypoints/lib/noframework.waypoints')).default;

    let skillsContent = document.querySelector('.skills-content');
    if (skillsContent) {
        const progressBars = document.querySelectorAll('.progress .progress-bar');

        new Waypoint({
            element: skillsContent,
            offset: '80%',
            handler: function () {
                progressBars.forEach((el) => {
                    el.style.width = el.getAttribute('aria-valuenow') + '%';
                });
                this.destroy();
            }
        });
    }
})();


window.bootstrap = bootstrap;
window.ApexCharts = ApexCharts;
window.Chart = Chart;
window.echarts = echarts;
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

    tinymce.init({
        selector: '#editor',
        plugins: 'link image code table',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | code | link image table',
        height: 400,
        branding: false,
    })
});
