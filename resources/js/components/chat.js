document.addEventListener("alpine:init", () => {
    Alpine.data("chat", (params) => {
        return {
            receivedMessages: params.receivedMessages,
            loggedUser: params.loggedUser,
            chatUser: params.chatUser,
            message: '',
            init() {
                window.Echo.private(`chats.${this.loggedUser.id}.${this.chatUser.id}`)
                    .listen('PrivateEvent', event => {
                        this.receivedMessages.push(event.message);
                        this.smoothScroll()
                    });

                this.smoothScroll()
            },
            sendMessage() {
                this.$wire.emit("sendMessage", this.message)
                this.receivedMessages.push(
                    {
                        'from_user_id': this.loggedUser.id,
                        'to_user_id': this.chatUser.id ,
                        'content': this.message
                    }
                );
                this.smoothScroll();
                this.message = "";

            },
            smoothScroll() {
                setTimeout(() => {
                    this.$refs.chatContainer.scroll({
                        top: this.$refs.chatContainer.scrollHeight,
                        behavior: 'smooth'
                    })
                }, 100)
            },
            ...params,
        }
    });
});

