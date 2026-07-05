document.addEventListener('alpine:init', () => {
    // Set Locale Moment.js
    moment.locale('id');

    Alpine.data('reservationTable', () => ({
        // Mengambil data dari bridge yang kita buat di Blade
        dates: window.laravelData.dates || [],
        stats: window.laravelData.stats || {},
        currentIndex: 0,
        showEditModal: false,
        showAddModal: false,
        editData: {
            id: null,
            name: '',
            phone: '',
            date: '',
            session: 1,
            guest_count: 1,
            type: 'Reguler',
            area: '',
            dp_status: 0,
            status: 'Reserved'
        },

        init() {
            console.log('Sistem Reservasi Siap');
            this.showEditModal = false;
        },

        get activeDate() {
            return this.dates[this.currentIndex];
        },

        // Navigasi Tanggal
        nextDate() {
            if (this.currentIndex < this.dates.length - 1) this.currentIndex++;
        },

        prevDate() {
            if (this.currentIndex > 0) this.currentIndex--;
        },

        // Modal Handler
        openEditModal(data) {
            // Deep copy agar perubahan sementara di modal tidak merusak tampilan tabel
            this.editData = { ...data };
            this.showEditModal = true;
        },

        // Helpers
        formatDisplayDate(date) {
            return moment(date).format('DD MMMM YYYY');
        },

        getStatusClass(status) {
            const classes = {
                'Reserved': 'bg-blue-100 text-blue-700 border-blue-200',
                'Seated': 'bg-emerald-100 text-emerald-700 border-emerald-200',
                'Finished': 'bg-purple-100 text-purple-700 border-purple-200',
                'Cancelled': 'bg-rose-100 text-rose-700 border-rose-200'
            };
            return classes[status] || 'bg-gray-100 text-gray-500';
        }
    }));
});