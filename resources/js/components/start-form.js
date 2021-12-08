document.addEventListener("alpine:init", () => {
    Alpine.data("startForm", (params) => {
        let dataEdit = []
        console.log(params.typeResource.initialValue);
        if( params.typeResource.initialValue === 'interests' ){
            dataEdit = params.interests
        }
        if( params.typeResource.initialValue === 'knowledge' ){
            dataEdit = params.knowledge
        }

        return {
            categories : params.categories,
            payload : params.payload,
            typeResource : params.typeResource,
            dataEdit : dataEdit,
            init() {
                this.loadEdit()
            },
            loadEdit() {
                if(this.dataEdit) {
                    for (let index = 0; index < this.dataEdit.length; ++index) {
                        this.payload.push({
                            category_id: this.dataEdit[index].skill.category_id,
                            id: this.dataEdit[index].skill.id,
                            level: this.dataEdit[index].level,
                            name: this.dataEdit[index].skill.name
                        })
                    }
                }
            },
            changeSkill(selectedCategory, event, el) {
                const category = this.categories.find((item) => item.name === selectedCategory)
                const skill = category.skills.find(item => item.id === parseInt(event.target.value))

                this.payload.push({
                    category_id: skill.category_id,
                    id: skill.id,
                    level: 0,
                    name: skill.name
                })

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
            removeSkill(position, category_id) {
                const skill = this.payload.splice(position, 1)

                this.categories = this.categories.map((item) => {
                    if (item.id === category_id) {
                        item.skills.push(skill[0])
                    }

                    return item;
                })
            },
            ...params,
        }
    });
});

