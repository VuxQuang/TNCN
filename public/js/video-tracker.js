document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slides');
    const totalQuestions = slides.length;
    let currentSlide = 0;
    let correctCount = 0;
    let answeredQuestions = 0;

    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const questionNumber = document.getElementById('question-number');

    // Cập nhật tổng số câu hỏi trong phần hiển thị kết quả
    document.getElementById('total-questions').textContent = totalQuestions;

    // Hiển thị slide đầu tiên
    slides[currentSlide].classList.add('active');
    updateQuestionNumber();

    // Hàm hiển thị slide
    function showSlide(n) {
        slides[currentSlide].classList.remove('active');
        slides[n].classList.add('active');
        currentSlide = n;
        updateQuestionNumber();

        // Vô hiệu hoá/kích hoạt các nút điều hướng
        prevBtn.disabled = currentSlide === 0;
        nextBtn.disabled = currentSlide === totalQuestions - 1;
    }

    // Hàm cập nhật số thứ tự câu hỏi
    function updateQuestionNumber() {
        questionNumber.textContent = `Câu hỏi ${currentSlide + 1}/${totalQuestions}`;
    }

    // Xử lý khi người dùng chọn câu trả lời
    slides.forEach((slide, index) => {
        const answers = slide.querySelectorAll('.answer');
        const correctAnswer = slide.dataset.correctAnswer;

        answers.forEach(answer => {
            answer.addEventListener('click', function() {
                // Ngăn chặn việc chọn lại câu trả lời
                if (slide.classList.contains('answered')) return;

                answeredQuestions++;

                // Đánh dấu slide đã được trả lời
                slide.classList.add('answered');

                const selectedAnswer = this.textContent.trim();

                // Kiểm tra câu trả lời đúng
                if (selectedAnswer === correctAnswer) {
                    this.classList.add('correct');
                    correctCount++;
                } else {
                    this.classList.add('incorrect');
                }

                // Tự động chuyển sang slide tiếp theo sau 1 giây
                setTimeout(() => {
                    if (currentSlide < totalQuestions - 1) {
                        showSlide(currentSlide + 1);
                    }
                    // Hiển thị kết quả sau khi hoàn thành tất cả các câu hỏi
                    if (answeredQuestions === totalQuestions) {
                        document.getElementById('correct-count').textContent = correctCount;
                        document.getElementById('result-message').textContent = correctCount >= 0.6 * totalQuestions
                            ? 'おめでとうございます！あなたはレッスンを完了しました。'
                            : 'あなたはレッスンを完了していません。もう一度試してください！';
                        document.querySelector('.results').style.display = 'flex';
                    }
                }, 1000);
            });
        });
    });

    // Sự kiện nút "Trước"
    prevBtn.addEventListener('click', function() {
        if (currentSlide > 0) {
            showSlide(currentSlide - 1);
        }
    });

    // Sự kiện nút "Tiếp theo"
    nextBtn.addEventListener('click', function() {
        if (currentSlide < totalQuestions - 1) {
            showSlide(currentSlide + 1);
        }
    });

    // Sự kiện nút đóng
    document.getElementById('close-btn').addEventListener('click', function() {
        document.querySelector('.results').style.display = 'none';
        // Đặt lại biến để bắt đầu lại bài quiz
        currentSlide = 0;
        correctCount = 0;
        answeredQuestions = 0;
        slides.forEach(slide => {
            slide.classList.remove('answered', 'correct', 'incorrect');
        });
        showSlide(currentSlide);
    });
});
document.getElementById('close-btn').addEventListener('click', function() {
    // Tùy chọn để đóng thông báo
    document.querySelector('.results').style.display = 'none';
});

// Thêm một nút để chuyển đến bài học tiếp theo
document.querySelector('.results button').addEventListener('click', function() {
    window.location.href = `http://127.0.0.1:8000/video/${nextLessonId}`;
});

