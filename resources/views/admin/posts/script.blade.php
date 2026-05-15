<script>
    function thumbnailUploader(defaultPreview = null) {
        return {
            mode: @json($mode ?? 'create'),
            readonly: false,
            preview: defaultPreview,

            init() {
                this.readonly = this.mode == 'show'
            },

            handlePreview(event) {

                const file = event.target.files[0]

                if (!file) return

                this.preview = URL.createObjectURL(file)
            },

            removePreview() {

                this.preview = null

                document.querySelector('input[name="thumbnail"]').value = ''

            }

        }
    }
</script>
