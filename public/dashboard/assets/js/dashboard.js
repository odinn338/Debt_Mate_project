/* ============================================
   Debt Mate - Dashboard JavaScript
   ملف الجافاسكريبت الرئيسي للتفاعلية
   ============================================ */

// ============================================
// 1. تشغيل الكود بعد تحميل الصفحة
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 Debt Mate Dashboard Loaded!');
    
    // تفعيل جميع الوظائف
    initNavigation();
    initStatCards();
    initNotifications();
    initPaymentCards();
    animateNumbers();
    initTooltips();
});

// ============================================
// 2. Navigation - تفعيل القائمة الجانبية
// ============================================
function initNavigation() {
    const navItems = document.querySelectorAll('.nav-item');
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // إزالة active من جميع العناصر
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // إضافة active للعنصر المضغوط
            this.classList.add('active');
            
            // تأثير صوتي (اختياري)
            playClickSound();
        });
    });
}

// ============================================
// 3. Statistics Cards - تفاعل بطاقات الإحصائيات
// ============================================
function initStatCards() {
    const statCards = document.querySelectorAll('.stat-card');
    
    statCards.forEach(card => {
        // تأثير عند التمرير
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
        
        // تأثير عند الضغط
        card.addEventListener('click', function() {
            this.style.transform = 'translateY(-5px) scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            }, 150);
        });
    });
}

// ============================================
// 4. Animate Numbers - تحريك الأرقام عند التحميل
// ============================================
function animateNumbers() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    statNumbers.forEach(element => {
        const finalValue = element.textContent;
        const numericValue = parseFloat(finalValue.replace(/[^\d.]/g, ''));
        const currency = finalValue.replace(/[\d,.\s]/g, '');
        
        let currentValue = 0;
        const increment = numericValue / 50; // 50 خطوة
        const duration = 1500; // 1.5 ثانية
        const stepTime = duration / 50;
        
        element.textContent = '0 ' + currency;
        
        const timer = setInterval(() => {
            currentValue += increment;
            
            if (currentValue >= numericValue) {
                element.textContent = formatNumber(numericValue) + ' ' + currency;
                clearInterval(timer);
            } else {
                element.textContent = formatNumber(Math.floor(currentValue)) + ' ' + currency;
            }
        }, stepTime);
    });
}

// تنسيق الأرقام بالفواصل
function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// ============================================
// 5. Notifications - التنبيهات التفاعلية
// ============================================
function initNotifications() {
    const notificationBtn = document.querySelector('.btn-notification');
    const notificationItems = document.querySelectorAll('.notification-item');
    
    // عند الضغط على زر التنبيهات
    if (notificationBtn) {
        notificationBtn.addEventListener('click', function() {
            // يمكن إضافة Modal هنا
            showNotificationPanel();
        });
    }
    
    // عند الضغط على تنبيه معين
    notificationItems.forEach(item => {
        item.addEventListener('click', function() {
            // تأثير القراءة
            this.style.opacity = '0.6';
            setTimeout(() => {
                this.style.opacity = '1';
            }, 200);
            
            // يمكن إضافة وظيفة لفتح تفاصيل التنبيه
            handleNotificationClick(this);
        });
    });
}

function showNotificationPanel() {
    console.log('📬 Notification Panel Opened');
    // هنا يمكن إضافة Modal أو Panel منبثق
}

function handleNotificationClick(notification) {
    const title = notification.querySelector('h4').textContent;
    console.log('🔔 Notification clicked:', title);
    
    // يمكن إضافة alert أو modal
    // alert('تم قراءة: ' + title);
}

// ============================================
// 6. Transaction Items - المعاملات التفاعلية
// ============================================
const transactionItems = document.querySelectorAll('.transaction-item');

transactionItems.forEach(item => {
    item.addEventListener('click', function() {
        const title = this.querySelector('h4').textContent;
        const amount = this.querySelector('.transaction-amount').textContent;
        
        console.log('💰 Transaction:', title, '-', amount);
        
        // تأثير بصري
        this.style.background = 'rgba(223, 182, 178, 0.15)';
        setTimeout(() => {
            this.style.background = 'rgba(0, 0, 0, 0.2)';
        }, 300);
    });
});

// ============================================
// 7. Payment Cards - بطاقات الدفع
// ============================================
function initPaymentCards() {
    const payButtons = document.querySelectorAll('.btn-pay');
    
    payButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const card = this.closest('.payment-card');
            const paymentTitle = card.querySelector('h3').textContent;
            const paymentAmount = card.querySelector('.payment-amount').textContent;
            
            // تأثير التحميل
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري المعالجة...';
            this.disabled = true;
            
            // محاكاة عملية الدفع
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-check"></i> تم السداد بنجاح!';
                this.style.background = 'linear-gradient(135deg, #4CAF50 0%, #45a049 100%)';
                
                // إظهار رسالة نجاح
                showSuccessMessage(paymentTitle, paymentAmount);
                
                // إعادة الزر لحالته الطبيعية بعد 3 ثواني
                setTimeout(() => {
                    this.innerHTML = 'سداد الآن';
                    this.disabled = false;
                    this.style.background = '';
                }, 3000);
            }, 2000);
        });
    });
}

function showSuccessMessage(title, amount) {
    // إنشاء رسالة منبثقة
    const message = document.createElement('div');
    message.className = 'success-toast';
    message.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>تم السداد بنجاح!</strong>
            <p>${title} - ${amount}</p>
        </div>
    `;
    
    // إضافة الستايل
    message.style.cssText = `
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%) translateY(-100px);
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        gap: 1rem;
        z-index: 9999;
        transition: transform 0.5s ease;
        font-family: 'Cairo', sans-serif;
    `;
    
    document.body.appendChild(message);
    
    // تحريك الرسالة للأسفل
    setTimeout(() => {
        message.style.transform = 'translateX(-50%) translateY(0)';
    }, 100);
    
    // إخفاء الرسالة بعد 3 ثواني
    setTimeout(() => {
        message.style.transform = 'translateX(-50%) translateY(-100px)';
        setTimeout(() => {
            document.body.removeChild(message);
        }, 500);
    }, 3000);
}

// ============================================
// 8. Filter Tabs - تبويبات الفلترة
// ============================================
const filterButtons = document.querySelectorAll('.filter-tabs button');

filterButtons.forEach(button => {
    button.addEventListener('click', function() {
        // إزالة active من جميع الأزرار
        filterButtons.forEach(btn => btn.classList.remove('active'));
        
        // إضافة active للزر المضغوط
        this.classList.add('active');
        
        // تطبيق الفلتر (يمكن تطويره لاحقاً)
        const filterType = this.textContent;
        console.log('🔍 Filter applied:', filterType);
        
        // تأثير بصري
        const paymentCards = document.querySelectorAll('.payment-card');
        paymentCards.forEach(card => {
            card.style.opacity = '0.3';
            setTimeout(() => {
                card.style.opacity = '1';
            }, 300);
        });
    });
});

// ============================================
// 9. Time Filter - فلتر الوقت للرسوم البيانية
// ============================================
const timeFilterButtons = document.querySelectorAll('.time-filter button');

timeFilterButtons.forEach(button => {
    button.addEventListener('click', function() {
        // إزالة active من جميع الأزرار
        timeFilterButtons.forEach(btn => btn.classList.remove('active'));
        
        // إضافة active للزر المضغوط
        this.classList.add('active');
        
        const period = this.textContent;
        console.log('📅 Time period changed:', period);
        
        // هنا يمكن تحديث الرسم البياني
        // updateChart(period);
    });
});

// ============================================
// 10. Tooltips - تلميحات عند التمرير
// ============================================
function initTooltips() {
    const elements = document.querySelectorAll('[data-tooltip]');
    
    elements.forEach(element => {
        element.addEventListener('mouseenter', function(e) {
            const tooltipText = this.getAttribute('data-tooltip');
            const tooltip = createTooltip(tooltipText);
            
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 10) + 'px';
            tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
            
            setTimeout(() => {
                tooltip.style.opacity = '1';
            }, 10);
        });
        
        element.addEventListener('mouseleave', function() {
            const tooltip = document.querySelector('.custom-tooltip');
            if (tooltip) {
                tooltip.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(tooltip);
                }, 200);
            }
        });
    });
}

function createTooltip(text) {
    const tooltip = document.createElement('div');
    tooltip.className = 'custom-tooltip';
    tooltip.textContent = text;
    tooltip.style.cssText = `
        position: fixed;
        background: rgba(43, 18, 76, 0.95);
        color: #FBE4D8;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        z-index: 10000;
        opacity: 0;
        transition: opacity 0.2s ease;
        pointer-events: none;
        font-family: 'Cairo', sans-serif;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
    `;
    return tooltip;
}

// ============================================
// 11. Progress Bars Animation - تحريك أشرطة التقدم
// ============================================
function animateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-fill');
    
    progressBars.forEach(bar => {
        const targetWidth = bar.style.width;
        bar.style.width = '0';
        
        setTimeout(() => {
            bar.style.width = targetWidth;
        }, 500);
    });
}

// تفعيل تحريك أشرطة التقدم عند التحميل
window.addEventListener('load', animateProgressBars);

// ============================================
// 12. Scroll Animations - تأثيرات عند السكرول
// ============================================
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // مراقبة جميع العناصر
    const animatedElements = document.querySelectorAll('.stat-card, .chart-card, .info-card, .payment-card');
    
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'all 0.6s ease';
        observer.observe(element);
    });
}

// تفعيل تأثيرات السكرول
initScrollAnimations();

// ============================================
// 13. Click Sound Effect - تأثير صوتي (اختياري)
// ============================================
function playClickSound() {
    // يمكن إضافة تأثير صوتي خفيف
    // const audio = new Audio('assets/sounds/click.mp3');
    // audio.volume = 0.2;
    // audio.play();
}

// ============================================
// 14. Keyboard Shortcuts - اختصارات الكيبورد
// ============================================
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + N = إضافة دين جديد
    if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
        e.preventDefault();
        const addBtn = document.querySelector('.btn-primary');
        if (addBtn) {
            addBtn.click();
        }
    }
    
    // Ctrl/Cmd + / = البحث
    if ((e.ctrlKey || e.metaKey) && e.key === '/') {
        e.preventDefault();
        console.log('🔍 Search shortcut activated');
    }
});

// ============================================
// 15. Real-time Clock - ساعة في الوقت الحقيقي
// ============================================
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('ar-EG', {
        hour: '2-digit',
        minute: '2-digit'
    });
    const dateString = now.toLocaleDateString('ar-EG', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    // يمكن إضافة عنصر للساعة في الـ Header
    console.log('🕐', timeString, '-', dateString);
}

// تحديث الساعة كل دقيقة
setInterval(updateClock, 60000);

// ============================================
// 16. Print & Export Functions
// ============================================
function printDashboard() {
    window.print();
}

function exportToPDF() {
    console.log('📄 Exporting dashboard to PDF...');
    // يمكن استخدام مكتبة مثل jsPDF
}

// ============================================
// 17. Dark Mode Toggle (إضافي)
// ============================================
function toggleDarkMode() {
    document.body.classList.toggle('light-mode');
    const isDark = !document.body.classList.contains('light-mode');
    localStorage.setItem('darkMode', isDark);
}

// تحميل وضع الشاشة المحفوظ
window.addEventListener('load', function() {
    const savedMode = localStorage.getItem('darkMode');
    if (savedMode === 'false') {
        document.body.classList.add('light-mode');
    }
});

// ============================================
// 18. Local Storage - حفظ البيانات محلياً
// ============================================
function saveToLocalStorage(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

function getFromLocalStorage(key) {
    const data = localStorage.getItem(key);
    return data ? JSON.parse(data) : null;
}

