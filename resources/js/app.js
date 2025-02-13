import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
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

// import './ui.js'

AOS.init({
    duration: 1000,
    easing: 'ease-in-out',
    once: true,
    mirror: false,
});

window.ApexCharts = ApexCharts;
window.Chart = Chart;
window.echarts = echarts;
window.FullCalendar = {
    Calendar,
    dayGridPlugin,
    interactionPlugin,
};
