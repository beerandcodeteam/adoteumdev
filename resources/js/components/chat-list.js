document.addEventListener("alpine:init", () => {
    Alpine.data("chatList", (params) => {
        return {
            showActions(index) {
                this.$refs[`recruiterBg${index}`].classList.remove("hidden")
                this.$refs[`recruiterBg${index}`].classList.add("flex")

                this.$refs[`recruiterActions${index}`].classList.remove("hidden")
                this.$refs[`recruiterActions${index}`].classList.add("flex")
            },
            hideActions(index) {
                this.$refs[`recruiterBg${index}`].classList.remove("flex")
                this.$refs[`recruiterBg${index}`].classList.add("hidden")

                this.$refs[`recruiterActions${index}`].classList.remove("flex")
                this.$refs[`recruiterActions${index}`].classList.add("hidden")
            },
            action(devid, name) {
                this.$wire.action(devid, name)
            },
            ...params,
        }
    });
});

