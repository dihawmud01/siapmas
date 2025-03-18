import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';

import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

FilePond.registerPlugin(FilePondPluginFileValidateSize, FilePondPluginFileValidateType);

document.addEventListener('DOMContentLoaded', () => {
    const inputEl = document.querySelectorAll('input[type="file"]');

    if (inputEl) {
        inputEl.forEach((input) => {
            FilePond.create(input, {
                allowMultiple: input.hasAttribute('multiple'),
                maxFileSize: '10MB',
                maxTotalFileSize: '50MB',
                acceptedFileTypes: input
                    .getAttribute('accept')
                    ?.split(',')
                    .map((type) => type.trim()) || ['*'],
                labelMaxFileSizeExceeded: 'Ukuran file terlalu besar! Maksimal 10MB.',
                labelFileTypeNotAllowed: 'Jenis file tidak diperbolehkan.',
                fileValidateTypeLabelExpectedTypes: '',
                storeAsFile: true,
            });
        });
    }
});
