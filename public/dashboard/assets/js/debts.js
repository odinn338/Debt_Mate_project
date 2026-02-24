/* ============================================
   Debts Page - JavaScript
   وظائف صفحة إدارة الديون
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {
    console.log('📋 Debts Page Loaded');
    
    // تفعيل جميع الوظائف
    initModal();
    initFilters();
    initSearch();
    initViewToggle();
    initDebtActions();
});

// ============================================
// 1. Modal - نافذة إضافة دين
// ============================================
function initModal() {
    const modal = document.getElementById('addDebtModal');
    const addBtn = document.getElementById('addDebtBtn');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('addDebtForm');
    
    // فتح Modal
    if (addBtn) {
        addBtn.addEventListener('click', function() {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    // إغلاق Modal
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        form.reset();
    }
    
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
    
    // إغلاق عند الضغط خارج المحتوى
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // معالجة إرسال النموذج
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            handleAddDebt(new FormData(form));
            closeModal();
        });
    }
}

function handleAddDebt(formData) {
    const debtData = {
        title: formData.get('title'),
        amount: formData.get('amount'),
        category: formData.get('category'),
        due_date: formData.get('due_date'),
        priority: formData.get('priority'),
        notes: formData.get('notes'),
        recurring: formData.get('recurring') === 'on'
    };
    
    console.log('📝 Adding new debt:', debtData);
    
    // هنا يمكن إرسال البيانات للسيرفر
    // await fetch('/api/debts', { method: 'POST', body: JSON.stringify(debtData) });
    
    // إظهار رسالة نجاح
    showNotification('تم إضافة الدين بنجاح! 🎉', 'success');
    
    // إضافة البطاقة للصفحة
    addDebtCard(debtData);
    
    // تحديث الإحصائيات
    updateStats();
}

function addDebtCard(data) {
    const container = document.getElementById('debtsContainer');
    
    const card = document.createElement('div');
    card.className = 'debt-card';
    card.setAttribute('data-status', 'active');
    card.setAttribute('data-category', data.category);
    
    card.innerHTML = `
        <div class="debt-card-header">
            <div class="debt-category ${data.category}">
                <i class="fas fa-file-invoice"></i>
                <span>${getCategoryName(data.category)}</span>
            </div>
            <div class="debt-status active">
                <i class="fas fa-circle"></i>
                نشط
            </div>
        </div>
        <h3 class="debt-title">${data.title}</h3>
        <div class="debt-amount">
            <span class="amount-label">المبلغ الإجمالي</span>
            <span class="amount-value">${formatNumber(data.amount)} ج.م</span>
        </div>
        <div class="debt-progress">
            <div class="progress-info">
                <span>المسدد: 0 ج.م</span>
                <span>0%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 0%;"></div>
            </div>
        </div>
        <div class="debt-details">
            <div class="detail-item">
                <i class="fas fa-calendar"></i>
                <span>الاستحقاق: ${formatDate(data.due_date)}</span>
            </div>
            <div class="detail-item">
                <i class="fas fa-sticky-note"></i>
                <span>${data.notes || 'لا توجد ملاحظات'}</span>
            </div>
        </div>
        <div class="debt-actions">
            <button class="btn-action btn-pay">
                <i class="fas fa-money-bill"></i>
                سداد
            </button>
            <button class="btn-action btn-edit">
                <i class="fas fa-edit"></i>
                تعديل
            </button>
            <button class="btn-action btn-delete">
                <i class="fas fa-trash"></i>
                حذف
            </button>
        </div>
    `;
    
    container.insertBefore(card, container.firstChild);
    
    // تفعيل الأزرار للبطاقة الجديدة
    initCardActions(card);
    
    // تأثير Animation
    card.style.opacity = '0';
    card.style.transform = 'translateY(-20px)';
    setTimeout(() => {
        card.style.transition = 'all 0.5s ease';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, 100);
}

function getCategoryName(category) {
    const categories = {
        'bank': 'بنك',
        'bills': 'فواتير',
        'loans': 'قرض',
        'personal': 'شخصي',
        'other': 'أخرى'
    };
    return categories[category] || category;
}

// ============================================
// 2. Filters - الفلاتر
// ============================================
function initFilters() {
    const statusFilter = document.getElementById('statusFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const sortFilter = document.getElementById('sortFilter');
    const resetBtn = document.getElementById('resetFilters');
    
    // تطبيق الفلاتر
    [statusFilter, categoryFilter, sortFilter].forEach(filter => {
        if (filter) {
            filter.addEventListener('change', applyFilters);
        }
    });
    
    // إعادة تعيين الفلاتر
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            statusFilter.value = 'all';
            categoryFilter.value = 'all';
            sortFilter.value = 'date-desc';
            document.getElementById('searchInput').value = '';
            applyFilters();
            showNotification('تم إعادة تعيين الفلاتر', 'info');
        });
    }
}

function applyFilters() {
    const status = document.getElementById('statusFilter').value;
    const category = document.getElementById('categoryFilter').value;
    const sort = document.getElementById('sortFilter').value;
    const search = document.getElementById('searchInput').value.toLowerCase();
    
    const cards = document.querySelectorAll('.debt-card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        const cardCategory = card.getAttribute('data-category');
        const cardTitle = card.querySelector('.debt-title').textContent.toLowerCase();
        
        // فلترة حسب الحالة
        const statusMatch = status === 'all' || cardStatus === status;
        
        // فلترة حسب الفئة
        const categoryMatch = category === 'all' || cardCategory === category;
        
        // فلترة حسب البحث
        const searchMatch = search === '' || cardTitle.includes(search);
        
        // إظهار/إخفاء البطاقة
        if (statusMatch && categoryMatch && searchMatch) {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // تحديث عداد النتائج
    updateResultsCount(visibleCount, cards.length);
    
    // تطبيق الترتيب
    sortCards(sort);
}

function sortCards(sortType) {
    const container = document.getElementById('debtsContainer');
    const cards = Array.from(container.querySelectorAll('.debt-card'));
    
    cards.sort((a, b) => {
        switch(sortType) {
            case 'date-desc':
                return 1; // الأحدث أولاً (افتراضياً)
            case 'date-asc':
                return -1; // الأقدم أولاً
            case 'amount-desc':
                const amountA = parseFloat(a.querySelector('.amount-value').textContent.replace(/[^\d]/g, ''));
                const amountB = parseFloat(b.querySelector('.amount-value').textContent.replace(/[^\d]/g, ''));
                return amountB - amountA;
            case 'amount-asc':
                const amountA2 = parseFloat(a.querySelector('.amount-value').textContent.replace(/[^\d]/g, ''));
                const amountB2 = parseFloat(b.querySelector('.amount-value').textContent.replace(/[^\d]/g, ''));
                return amountA2 - amountB2;
            default:
                return 0;
        }
    });
    
    // إعادة ترتيب البطاقات
    cards.forEach(card => container.appendChild(card));
}

function updateResultsCount(visible, total) {
    const countElement = document.querySelector('.results-count span');
    if (countElement) {
        countElement.innerHTML = `عرض <strong>${visible}</strong> من أصل <strong>${total}</strong> دين`;
    }
}

// ============================================
// 3. Search - البحث
// ============================================
function initSearch() {
    const searchInput = document.getElementById('searchInput');
    
    if (searchInput) {
        // البحث الفوري
        searchInput.addEventListener('input', function() {
            applyFilters();
        });
        
        // مسح البحث بـ Escape
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                applyFilters();
            }
        });
    }
}

// ============================================
// 4. View Toggle - تبديل العرض
// ============================================
function initViewToggle() {
    const viewButtons = document.querySelectorAll('.view-btn');
    const container = document.getElementById('debtsContainer');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.getAttribute('data-view');
            
            // تحديث الأزرار النشطة
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // تغيير العرض
            if (view === 'grid') {
                container.classList.remove('list-view');
                container.classList.add('grid-view');
            } else {
                container.classList.remove('grid-view');
                container.classList.add('list-view');
            }
            
            // حفظ التفضيل
            localStorage.setItem('debts-view', view);
        });
    });
    
    // تحميل العرض المحفوظ
    const savedView = localStorage.getItem('debts-view');
    if (savedView === 'list') {
        document.querySelector('[data-view="list"]').click();
    }
}

// ============================================
// 5. Debt Actions - أزرار البطاقات
// ============================================
function initDebtActions() {
    const cards = document.querySelectorAll('.debt-card');
    cards.forEach(card => initCardActions(card));
}

function initCardActions(card) {
    const payBtn = card.querySelector('.btn-pay');
    const editBtn = card.querySelector('.btn-edit');
    const deleteBtn = card.querySelector('.btn-delete');
    const viewBtn = card.querySelector('.btn-view');
    
    if (payBtn) {
        payBtn.addEventListener('click', function() {
            handlePayDebt(card);
        });
    }
    
    if (editBtn) {
        editBtn.addEventListener('click', function() {
            handleEditDebt(card);
        });
    }
    
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            handleDeleteDebt(card);
        });
    }
    
    if (viewBtn) {
        viewBtn.addEventListener('click', function() {
            handleViewDebt(card);
        });
    }
}

function handlePayDebt(card) {
    const title = card.querySelector('.debt-title').textContent;
    const amount = card.querySelector('.amount-value').textContent;
    
    if (confirm(`هل تريد تسجيل دفعة لـ ${title}؟`)) {
        showNotification('جاري فتح صفحة السداد...', 'info');
        
        // الانتقال لصفحة السداد
        setTimeout(() => {
            window.location.href = 'payments.html?debt=' + encodeURIComponent(title);
        }, 1000);
    }
}

function handleEditDebt(card) {
    const title = card.querySelector('.debt-title').textContent;
    
    showNotification(`فتح نافذة تعديل: ${title}`, 'info');
    
    // يمكن فتح Modal للتعديل
    // const modal = createEditModal(card);
    // document.body.appendChild(modal);
}

function handleDeleteDebt(card) {
    const title = card.querySelector('.debt-title').textContent;
    
    if (confirm(`هل أنت متأكد من حذف "${title}"؟\nهذا الإجراء لا يمكن التراجع عنه.`)) {
        // تأثير الحذف
        card.style.transition = 'all 0.5s ease';
        card.style.opacity = '0';
        card.style.transform = 'translateX(100%)';
        
        setTimeout(() => {
            card.remove();
            showNotification('تم حذف الدين بنجاح', 'success');
            updateStats();
            applyFilters();
        }, 500);
    }
}

function handleViewDebt(card) {
    const title = card.querySelector('.debt-title').textContent;
    
    showNotification(`عرض تفاصيل: ${title}`, 'info');
    
    // يمكن فتح Modal للعرض
}

// ============================================
// 6. Update Stats - تحديث الإحصائيات
// ============================================
function updateStats() {
    const cards = document.querySelectorAll('.debt-card');
    
    let total = cards.length;
    let active = 0;
    let paid = 0;
    let overdue = 0;
    
    cards.forEach(card => {
        const status = card.getAttribute('data-status');
        if (status === 'active') active++;
        if (status === 'paid') paid++;
        if (status === 'overdue') overdue++;
    });
    
    // تحديث الأرقام
    document.querySelectorAll('.debt-stat-card.total .stat-number')[0].textContent = total;
    document.querySelectorAll('.debt-stat-card.active .stat-number')[0].textContent = active;
    document.querySelectorAll('.debt-stat-card.paid .stat-number')[0].textContent = paid;
    document.querySelectorAll('.debt-stat-card.overdue .stat-number')[0].textContent = overdue;
}

// ============================================
// 7. Helper Functions - وظائف مساعدة
// ============================================
function formatNumber(num) {
    return new Intl.NumberFormat('ar-EG').format(num);
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('ar-EG', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    
    let icon = 'fa-info-circle';
    let bgColor = 'var(--color-info)';
    
    switch(type) {
        case 'success':
            icon = 'fa-check-circle';
            bgColor = 'var(--color-success)';
            break;
        case 'error':
            icon = 'fa-exclamation-circle';
            bgColor = 'var(--color-danger)';
            break;
        case 'warning':
            icon = 'fa-exclamation-triangle';
            bgColor = 'var(--color-warning)';
            break;
    }
    
    notification.innerHTML = `
        <i class="fas ${icon}"></i>
        <span>${message}</span>
    `;
    
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%) translateY(-100px);
        background: ${bgColor};
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        gap: 1rem;
        z-index: 10001;
        transition: transform 0.5s ease;
        font-family: 'Cairo', sans-serif;
        font-weight: 600;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(-50%) translateY(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(-50%) translateY(-100px)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 500);
    }, 3000);
}

// ============================================
// 8. Keyboard Shortcuts
// ============================================
document.addEventListener('keydown', function(e) {
    // Ctrl + N = إضافة دين جديد
    if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
        e.preventDefault();
        document.getElementById('addDebtBtn').click();
    }
    
    // Ctrl + F = التركيز على البحث
    if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
        e.preventDefault();
        document.getElementById('searchInput').focus();
    }
});

