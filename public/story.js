document.addEventListener('DOMContentLoaded', () => {
    const storyItems = document.querySelectorAll('.story-item');
    storyItems.forEach(item => {
        item.addEventListener('click', () => {
            const storyId = item.getAttribute('data-id');
            window.location.href = `${storyId}.html?id=${storyId}`;
        });
    });

    // Language Toggle
    const langBtn = document.getElementById('lang-btn');
    if (langBtn) {
        langBtn.addEventListener('click', () => {
            toggleLanguage();
        });

        // Set initial language based on localStorage
        const currentLang = localStorage.getItem('language') || 'vi';
        setLanguage(currentLang);
    }

    // If on story page, load the appropriate content
    if (window.location.pathname.endsWith('story.html')) {
        const urlParams = new URLSearchParams(window.location.search);
        const storyId = urlParams.get('id');
        loadStoryContent(storyId);
    }
});

// Function to toggle language
function toggleLanguage() {
    let currentLang = localStorage.getItem('language') || 'vi';
    currentLang = currentLang === 'vi' ? 'ja' : 'vi';
    setLanguage(currentLang);
}

// Function to set language
function setLanguage(lang) {
    localStorage.setItem('language', lang);
    const viElements = document.querySelectorAll('.lang-vi');
    const jaElements = document.querySelectorAll('.lang-ja');
    if (lang === 'vi') {
        viElements.forEach(el => el.style.display = 'block');
        jaElements.forEach(el => el.style.display = 'none');
        if (document.getElementById('lang-btn')) {
            document.getElementById('lang-btn').textContent = 'switch to Japanese';
        }
    } else {
        viElements.forEach(el => el.style.display = 'none');
        jaElements.forEach(el => el.style.display = 'block');
        if (document.getElementById('lang-btn')) {
            document.getElementById('lang-btn').textContent = 'switch to Vietnamese';
        }
    }
}

// Function to load story content based on ID
function loadStoryContent(id) {
    const storyTitle = document.getElementById('story-title');
    const storyContent = document.getElementById('story-content');

    // Sample story data
    const stories = {
        'story1': {
            'title_vi': 'Tấm Cám',
            'title_ja': 'Tam Cam',
            'content_vi': 'Đây là nội dung của câu chuyện 1 bằng tiếng Việt.',
            'content_ja': 'This is the content of story 1 in English.',
            'image': 'story_images/story1.jpg'
        },
        'story2': {
            'title_vi': 'Thánh Gióng',
            'title_ja': 'Thanh Giong',
            'content_vi': 'bằng tiếng Việt.',
            'content_ja': 'This is the content of story 2 in Japanese.',
            'image': 'story_images/story2.jpg'
        }
        // Add more stories as needed
    };

    const story = stories[id];
    if (story) {
        // Set title
        storyTitle.textContent = localStorage.getItem('language') === 'ja' ? story.title_ja : story.title_vi;

        // Set content
        storyContent.innerHTML = `
            <p class="lang-vi">${story.content_vi}</p>
            <p class="lang-ja" style="display:none;">${story.content_ja}</p>
            <img src="${story.image}" alt="${story.title_vi}">
        `;

        // Set language based on current selection
        const currentLang = localStorage.getItem('language') || 'vi';
        setLanguage(currentLang);
    } else {
        storyContent.innerHTML = '<p>Story not found.</p>';
    }
}
