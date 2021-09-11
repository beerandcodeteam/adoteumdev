document.addEventListener("alpine:init", () => {
    Alpine.data("startForm", (params) => {

        return {
            categories   : params.categories,
            payload      : params.payload,
            init() {
            },
            changeSkill(selectedCategory, event, el) {
                const category = this.categories.find((item) => item.name === selectedCategory)
                const skill = category.skills.find(item => item.id === parseInt(event.target.value))

                if (!this.payload) {
                    this.payload = {}
                }

                if (this.payload.hasOwnProperty(selectedCategory)) {
                    this.payload[selectedCategory].push({
                        ...skill,
                        level: 0
                    })
                } else {
                    this.payload[selectedCategory] = [{
                        ...skill,
                        level: 0
                    }]
                }

                const newSkills = category.skills.filter((item) => item.id !== skill.id)

                this.categories = this.categories.map((item) => {
                    if (item.name === selectedCategory) {
                        item.skills = newSkills
                    }

                    return item;
                })

                setTimeout(() => {
                    event.target.value = ""

                }, 100)

            },
            removeSkill(payloadCategory, position) {
                const skill = this.payload[payloadCategory].splice(position, 1)

                this.categories = this.categories.map((item) => {
                    if (item.name === payloadCategory) {
                        item.skills.push(skill[0])
                    }

                    return item;
                })
            },
            ...params,
        }
    });
});

