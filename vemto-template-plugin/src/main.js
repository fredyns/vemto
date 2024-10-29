module.exports = (vemto) => {

    return {

        canInstall() {
            return true
        },

        onInstall() {
            vemto.savePluginData({
                text: 'Installing Templates plugin'
            })
        },

        beforeCodeGenerationStart() {
            let data = vemto.getPluginData()

            vemto.log.info(data.text)
            //vemto.log.warning(`That's awesome!!! A Vemto plugin showing a message during code generation`)
        },

        templateReplacements() {
            vemto.log.message('Replacing templates')

            // Replace default templates
            const templates = [
                'ApiAuthController.vemtl',
                'ApiController.vemtl',
                'ApiHasManyController.vemtl',
                'ApiRoutes.vemtl',
                'Controller.vemtl',
                'HasManyDetailLivewireComponent.vemtl',
                'Model.vemtl',
                'Routes.vemtl',
                'views/frameworks/tailwind/AppLayout_ExtraBodyContent.vemtl',
                'views/frameworks/tailwind/AppLayout_MainHeaderContent.vemtl',
                'views/frameworks/tailwind/AppLayoutJetstream_ExtraBodyContent.vemtl',
                'views/frameworks/tailwind/CreateView.vemtl',
                'views/frameworks/tailwind/EditView.vemtl',
                'views/frameworks/tailwind/FormInputsView.vemtl',
                'views/frameworks/tailwind/HasManyDetailLivewireView.vemtl',
                'views/frameworks/tailwind/IndexView_Table.vemtl',
                'views/frameworks/tailwind/ShowView.vemtl',
                'views/inputs/blade/Checkbox.vemtl',
                'views/inputs/blade/Date.vemtl',
                'views/inputs/blade/DateTime.vemtl',
                'views/inputs/blade/Email.vemtl',
                'views/inputs/blade/File.vemtl',
                'views/inputs/blade/Image.vemtl',
                'views/inputs/blade/Number.vemtl',
                'views/inputs/blade/Password.vemtl',
                'views/inputs/blade/Select.vemtl',
                'views/inputs/blade/SelectForRelationship.vemtl',
                'views/inputs/blade/Text.vemtl',
                'views/inputs/blade/Textarea.vemtl',
                'views/inputs/blade/Url.vemtl',
            ];
            templates.forEach(function (path) {
                vemto.replaceTemplate(path, 'templates/' + path);
            });
        },

        copyableFiles() {
            const files = [
                'runcloud-deployment-script.sh',
                'runcloud-first-deployment.sh',
                'app/Helpers/NPWP.php',
                'dev/Vemto.postman_collection.json',
                'lang/en/text.php',
                'resources/js/app.js',
                'resources/views/components/inputs/basic.blade.php',
                'resources/views/components/inputs/checkbox.blade.php',
                'resources/views/components/inputs/date.blade.php',
                'resources/views/components/inputs/datetime.blade.php',
                'resources/views/components/inputs/email.blade.php',
                'resources/views/components/inputs/group.blade.php',
                'resources/views/components/inputs/hidden.blade.php',
                'resources/views/components/inputs/npwp.blade.php',
                'resources/views/components/inputs/number.blade.php',
                'resources/views/components/inputs/password.blade.php',
                'resources/views/components/inputs/select.blade.php',
                'resources/views/components/inputs/slider.blade.php',
                'resources/views/components/inputs/text.blade.php',
                'resources/views/components/inputs/textarea.blade.php',
                'resources/views/components/inputs/time.blade.php',
                'resources/views/components/inputs/toggle.blade.php',
                'resources/views/components/inputs/tomselect.blade.php',
                'resources/views/components/inputs/trix.blade.php',
                'resources/views/components/inputs/url.blade.php',
            ];
            return files.map(function (path) {
                return {
                    from: 'files/' + path,
                    to: path
                }
            });
        },

        nodePackages(packages) {

            // Adding packages
            packages.dependencies['@alpinejs/mask'] = '^3.14.1'

            return packages
        },
    }

}
