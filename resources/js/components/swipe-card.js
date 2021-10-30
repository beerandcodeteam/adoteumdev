document.addEventListener("alpine:init", () => {
    Alpine.data("swipeCard", (params) => {
        return {
            developers: params.developers,
            element: null,
            clicked: false,
            startX: 0,
            startY: 0,
            elementBoundary: null,
            cardBoxBoundary: null,
            like: false,
            dislike: false,
            percentage: 0,
            showelement: true,
            init() { },
            mouseclick(event) {
                this.clicked = true
                this.element = this.$refs.swipecard;
                this.elementBoundary = this.element.getBoundingClientRect();
                this.cardBoxBoundary = this.$refs.cardbox.getBoundingClientRect();
                this.startX = event.clientX
                this.startY = event.clientY
            },
            movingcard(event) {
                if (this.clicked) {
                    this.element.classList.add('transition')
                    let deltaX = event.clientX - this.startX
                    let deltaY = event.clientY - this.startY
                    this.element.style.left = `${this.elementBoundary.left + deltaX}px`
                    this.element.style.top = `${this.elementBoundary.top + deltaY}px`

                    let cardBoxWidth = this.cardBoxBoundary.width;
                    this.percentage = deltaX / cardBoxWidth;

                    this.dislike = false
                    this.like = false

                    this.$refs.actionbox.classList.remove('justify-start')
                    this.$refs.actionbox.classList.remove('justify-end')

                    if (this.percentage > 0) {
                        this.$refs.actionbox.classList.add('justify-start')
                        this.element.classList.add('rotate-6')
                        this.element.classList.remove('-rotate-6')
                        this.like = true
                        this.$refs.like.style.opacity = this.percentage
                        if (this.percentage >= 0.6) {
                            this.$refs.like.style.opacity = 1
                        }
                    } else {
                        this.$refs.actionbox.classList.add('justify-end')
                        this.element.classList.add('-rotate-6')
                        this.element.classList.remove('rotate-6')
                        this.dislike = true
                        this.$refs.dislike.style.opacity = -1 * this.percentage
                        if (this.percentage <= -0.6) {
                            this.$refs.dislike.style.opacity = 1
                        }
                    }
                }
            },
            releasecard() {
                this.element.classList.remove('transition')
                this.clicked = false
                this.element.classList.remove('rotate-6')
                this.element.classList.remove('-rotate-6')

                if (this.percentage >= 0.6) {
                    this.element.style.left = "10000px";
                } else if (this.percentage <= -0.6) {
                    this.element.style.left = "-10000px";
                } else {
                    this.element.style.left = 0;
                    this.element.style.top = 0;
                }

                this.like = false
                this.dislike = false


            },
            ...params,
        }
    });
});

