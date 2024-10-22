document.addEventListener('DOMContentLoaded', function () {
                    var menuToggle = document.getElementById('menu-toggle-1');
                    var menu = document.querySelector('.menu-1');

                    menuToggle.addEventListener('click', function (e) {
                        e.preventDefault();
                        menu.classList.toggle('show');

                        // Adjust body padding to accommodate the menu
                        if (menu.classList.contains('show')) {
                            document.body.style.paddingRight = getScrollBarWidth() + 'px';
                        } else {
                            document.body.style.paddingRight = '0';
                        }
                    });

                    // Function to get scrollbar width
                    function getScrollBarWidth() {
                        var inner = document.createElement('div');
                        inner.style.width = '100%';
                        inner.style.height = '200px';

                        var outer = document.createElement('div');
                        outer.style.position = 'absolute';
                        outer.style.top = '0';
                        outer.style.left = '0';
                        outer.style.visibility = 'hidden';
                        outer.style.width = '200px';
                        outer.style.height = '150px';
                        outer.style.overflow = 'hidden';
                        outer.appendChild(inner);

                        document.body.appendChild(outer);
                        var scrollbarWidth = outer.offsetWidth - outer.clientWidth;
                        document.body.removeChild(outer);

                        return scrollbarWidth;
                    }
                });