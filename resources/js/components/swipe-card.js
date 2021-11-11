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
                this.element = event.target;
                this.elementBoundary = this.element.getBoundingClientRect();
                this.cardBoxBoundary = this.$refs.cardbox.getBoundingClientRect();
                this.startX = event.clientX
                this.startY = event.clientY
            },
            movingcard(event, id) {
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

                    const actionbox = document.getElementById(`actionbox${id}`)
                    const like = document.getElementById(`like${id}`)
                    const dislike = document.getElementById(`dislike${id}`)

                    actionbox.classList.remove('justify-start')
                    actionbox.classList.remove('justify-end')

                    if (this.percentage > 0) {
                        actionbox.classList.add('justify-start')
                        this.element.classList.add('rotate-6')
                        this.element.classList.remove('-rotate-6')
                        this.like = true
                        like.style.opacity = this.percentage
                        like.classList.remove('hidden')
                        dislike.classList.add('hidden')
                        if (this.percentage >= 0.6) {
                            like.style.opacity = 1
                        }
                    } else {
                        actionbox.classList.add('justify-end')
                        this.element.classList.add('-rotate-6')
                        this.element.classList.remove('rotate-6')
                        this.dislike = true
                        dislike.style.opacity = -1 * this.percentage
                        dislike.classList.remove('hidden')
                        like.classList.add('hidden')
                        if (this.percentage <= -0.6) {
                            dislike.style.opacity = 1
                        }
                    }
                }
            },
            releasecard() {
                if (this.clicked)
                {
                    this.element.classList.remove('transition')
                    this.clicked = false
                    this.element.classList.remove('rotate-6')
                    this.element.classList.remove('-rotate-6')

                    if (this.percentage >= 0.6) {
                        this.action('like')
                    } else if (this.percentage <= -0.6) {
                        this.action('dislike')
                    } else {
                        this.element.style.left = 0;
                        this.element.style.top = 0;
                    }

                    this.like = false
                    this.dislike = false
                }

            },
            action(name) {
                if (this.developers.data.length > 0) {
                    const dev = this.developers.data[this.developers.data.length - 1]

                    this.element = document.getElementById(`dev${dev.id}`)

                    this.element.classList.remove('transition')
                    if (name === 'like') {
                        this.element.style['transition-duration'] = '0';
                        this.element.classList.add('rotate-6')
                        this.element.classList.remove('-rotate-6')
                        setTimeout(() => {
                            this.element.style['transition-duration'] = '1.5s';
                            this.element.style.left = "10000px";
                        },100)
                    } else if (name === 'dislike') {
                        this.element.style['transition-duration'] = '0';
                        this.element.classList.add('-rotate-6')
                        this.element.classList.remove('rotate-6')
                        setTimeout(() => {
                            this.element.style['transition-duration'] = '1.5s';
                            this.element.style.left = "-10000px";
                        },100)
                    } else {
                        this.element.style['transition-duration'] = '0.5s';
                        this.element.style.top = "-1000px";
                    }

                    setTimeout(() => {
                        this.$wire.action(dev.id, name)
                        this.developers.data.pop()
                    }, 500)
                }

            },
            ...params,
        }
    });
});

