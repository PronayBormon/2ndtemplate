    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('frontend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/js/menu.js') }}"></script>
    <script src="/frontend/assets/js/main.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{ asset('frontend/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('frontend/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <!-- Page JS -->



    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    {{-- Summer note  --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <!-- toaster  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>





    <script>
        $('#editor').summernote({
            placeholder: '',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

    <script>
        const themeLink = document.getElementById('theme-link');
        const coreLink = document.getElementById('core-link');
        const toggleBtn = document.getElementById('theme-toggle');
        const iconEl = toggleBtn.querySelector('i');

        const lightTheme = "{{ asset('frontend/assets/vendor/css/rtl/theme-default.css') }}";
        const darkTheme = "{{ asset('frontend/assets/vendor/css/rtl/theme-default-dark.css') }}";
        const lightCore = "{{ asset('frontend/assets/vendor/css/rtl/core.css') }}";
        const darkCore = "{{ asset('frontend/assets/vendor/css/rtl/core-dark.css') }}";

        // <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />

        // Initialize tooltip
        let tooltip = new bootstrap.Tooltip(toggleBtn, {
            title: '',
            fallbackPlacements: ['bottom']
        });

        // Load saved theme on page load
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                coreLink.setAttribute('href', darkCore);
                themeLink.setAttribute('href', darkTheme);
            } else {
                coreLink.setAttribute('href', lightCore);
                themeLink.setAttribute('href', lightTheme);
            }
            updateToggle();
        });

        function updateToggle() {
            if (themeLink.getAttribute('href') === lightTheme) {
                iconEl.className = 'fa-regular fa-moon'; // moon icon for dark mode
                tooltip.setContent({
                    '.tooltip-inner': 'Dark mode'
                });
            } else {
                iconEl.className = 'fa-regular fa-sun'; // sun icon for light mode
                tooltip.setContent({
                    '.tooltip-inner': 'Light mode'
                });
            }
        }

        // Toggle theme on button click
        toggleBtn.addEventListener('click', () => {
            if (themeLink.getAttribute('href') === lightTheme) {
                coreLink.setAttribute('href', darkCore);
                themeLink.setAttribute('href', darkTheme);
                localStorage.setItem('theme', 'dark');
            } else {
                coreLink.setAttribute('href', lightCore);
                themeLink.setAttribute('href', lightTheme);
                localStorage.setItem('theme', 'light');
            }
            updateToggle();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const eventStartDate = document.querySelector('#birthDate');

            if (eventStartDate) {
                flatpickr(eventStartDate, {
                    enableTime: true,
                    dateFormat: "Y-m-d\\TH:i:S", // proper datetime format
                    // altFormat: 'Y-m-dTH:i:S',
                    altInput: true,
                    onReady: function(selectedDates, dateStr, instance) {
                        if (instance.isMobile) {
                            instance.mobileInput.setAttribute('step', null);
                        }
                    }
                });
            }
        });
    </script>
    <!-- Dropify JS --><script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
    @stack('scripts')
