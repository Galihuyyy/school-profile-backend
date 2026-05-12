<script>
    function jobForm() {
        return {
            mode: @json($mode ?? 'create'),
            readonly: false,
            job: @json($job ?? null),
            requirementError: '',

            form: {
                title: @json(old('title', $job->title ?? '')),
                company_name: @json(old('company_name', $job->company_name ?? '')),
                location: @json(old('location', $job->location ?? '')),
                apply_link: @json(old('apply_link', $job->apply_link ?? '')),
                expired_at: @json(old('expired_at', $job->expired_at ?? '')),
                description: @json(old('description', $job->description ?? '')),
                status: @json(old('status', $job->status ?? '')),
                requirements: @json(old('form_requirements', isset($job->job_requirements) ? $job->job_requirements->pluck('requirement')->toArray() : [''])),
            },

            init() {
                this.readonly = this.mode === 'show'

                if (this.job) {
                    this.form = {
                        title: this.job.title,
                        company_name: this.job.company_name,
                        location: this.job.location,
                        apply_link: this.job.apply_link,
                        expired_at: this.job.expired_at,
                        description: this.job.description,
                        status: this.job.status,
                        requirements: this.job.job_requirements,
                    }
                }
            },

            addRequirement() {
                if (this.readonly) return

                const lastRequirement =
                    this.form.requirements[this.form.requirements.length - 1]

                if (!lastRequirement || lastRequirement.trim() === '') {
                    this.requirementError = 'Requirement wajib diisi.'
                    return
                }

                this.requirementError = ''

                this.form.requirements.push('')
            },

            removeRequirement(index) {
                if (this.readonly) return

                this.form.requirements.splice(index, 1)
            },
        }
    }
</script>