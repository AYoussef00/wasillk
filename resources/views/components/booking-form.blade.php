<div class="booking-form-container">
    <div class="booking-form">
        <div class="booking-form-header">
            <h3>احجز سيارتك الآن</h3>
            <p>املأ النموذج التالي وسنتواصل معك في أقرب وقت</p>
            <button type="button" class="close-form" id="closeBookingForm">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            
            <div class="form-group">
                <label for="name">الاسم الكامل</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسمك الكامل" required>
                <div class="invalid-feedback">يرجى إدخال الاسم الكامل</div>
            </div>

            <div class="form-group">
                <label for="phone">رقم الجوال</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="05xxxxxxxx" required>
                <div class="invalid-feedback">يرجى إدخال رقم جوال صحيح</div>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com">
                <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح</div>
            </div>

            <div class="form-group">
                <label for="preferred_time">الوقت المفضل للتواصل</label>
                <div class="custom-select">
                    <select class="form-control" id="preferred_time" name="preferred_time" required>
                        <option value="">اختر الوقت المناسب</option>
                        <option value="morning">صباحاً (9 صباحاً - 12 ظهراً)</option>
                        <option value="afternoon">ظهراً (12 ظهراً - 4 عصراً)</option>
                        <option value="evening">مساءً (4 مساءً - 9 مساءً)</option>
                    </select>
                </div>
                <div class="invalid-feedback">يرجى اختيار الوقت المفضل للتواصل</div>
            </div>

            <div class="form-group">
                <label for="notes">ملاحظات إضافية</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="أي ملاحظات إضافية تود إضافتها"></textarea>
            </div>

            <button type="submit" class="submit-btn">
                تأكيد الحجز
                <i class="fas fa-arrow-left mr-2"></i>
            </button>
        </form>

        <div class="booking-success">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h4>تم إرسال طلب الحجز بنجاح!</h4>
            <p>سنقوم بالتواصل معك في أقرب وقت ممكن</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bookingForm = document.getElementById('bookingForm');
    const closeBtn = document.getElementById('closeBookingForm');
    const formContainer = document.querySelector('.booking-form-container');
    const successMessage = document.querySelector('.booking-success');

    // Show form
    window.showBookingForm = function() {
        formContainer.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close form
    closeBtn.addEventListener('click', function() {
        formContainer.classList.remove('active');
        document.body.style.overflow = '';
    });

    // Close on outside click
    formContainer.addEventListener('click', function(e) {
        if (e.target === formContainer) {
            formContainer.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Form validation and submission
    bookingForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('.submit-btn');
        submitBtn.classList.add('loading');

        // Collect form data
        const formData = new FormData(this);

        // Send AJAX request
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            submitBtn.classList.remove('loading');
            if (data.success) {
                bookingForm.style.display = 'none';
                successMessage.classList.add('show');
                setTimeout(() => {
                    formContainer.classList.remove('active');
                    document.body.style.overflow = '';
                    // Reset form after hiding
                    setTimeout(() => {
                        bookingForm.reset();
                        bookingForm.style.display = 'block';
                        successMessage.classList.remove('show');
                    }, 500);
                }, 2000);
            } else {
                // Handle errors
                Object.keys(data.errors).forEach(key => {
                    const input = document.getElementById(key);
                    if (input) {
                        input.classList.add('is-invalid');
                        const feedback = input.nextElementSibling;
                        if (feedback && feedback.classList.contains('invalid-feedback')) {
                            feedback.textContent = data.errors[key][0];
                        }
                    }
                });
            }
        })
        .catch(error => {
            submitBtn.classList.remove('loading');
            console.error('Error:', error);
        });
    });

    // Remove validation errors on input
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>
@endpush 