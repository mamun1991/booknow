// timer.js

const InactivityTimeoutPlugin = {
    install(app, options) {
        const inactivityDuration = 3200000;

        let logoutTimer = null;

        function resetLogoutTimer() {
            clearTimeout(logoutTimer);
            startLogoutTimer();
        }

        function startLogoutTimer() {
            logoutTimer = setTimeout(() => {
                logout();
            }, inactivityDuration);
        }

        function logout() {
            // Customize the logout logic as needed
            localStorage.removeItem('loginInfo');
            // this.$router.push('/dashboard/login');
            // Redirect to the login page or perform any other logout logic
            // Example: router.push('/login');
        }

        function initializeListeners() {
            window.addEventListener('mousemove', resetLogoutTimer);
            window.addEventListener('keydown', resetLogoutTimer);
        }

        function cleanupListeners() {
            window.removeEventListener('mousemove', resetLogoutTimer);
            window.removeEventListener('keydown', resetLogoutTimer);
        }

        initializeListeners();
        startLogoutTimer();

        app.config.globalProperties.$resetLogoutTimer = resetLogoutTimer;
        app.config.globalProperties.$startLogoutTimer = startLogoutTimer;

        app.mixin({
            beforeDestroy() {
                cleanupListeners();
                clearTimeout(logoutTimer);
            },
        });
    },
};

export default InactivityTimeoutPlugin;
