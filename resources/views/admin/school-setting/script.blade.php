<script>
    function formHandler(data) {
        return {

            mode: @json($mode),
            readonly: true,
            logoPreview: null,
            
            init() {
                this.readonly = this.mode == 'index'
            },
            
            socmedModal: {
                open: false,
                key: null,
                url: ''
            },

            openSocmed(key) {
                this.socmedModal.key = key
                this.socmedModal.url = this.form[key] || ''
                this.socmedModal.open = true
            },

            form: {
                logo: data?.logo || '',
                name: data?.name || '',
                description: data?.description || '',
                akreditasi: data?.akreditasi || '',
                status: data?.status || '',
                location: data?.location || '',
                telephone: data?.telephone || '',
                email: data?.email || '',
                profile_video: data?.profile_video || '',

                instagram_url: data?.instagram_url || '',
                youtube_url: data?.facebook_url || '',
                facebook_url: data?.facebook_url || '',
                tiktok_url: data?.tiktok_url || '',
            },

            handleLogoUpload(e) {
                const file = e.target.files[0]
                if (!file) return

                if (file.size > 2 * 1024 * 1024) {
                    alert('Max 2MB')
                    return
                }

                this.logoPreview = URL.createObjectURL(file)
            }
        }
    }
</script>