import { Controller } from "@hotwired/stimulus";
import { getComponent } from '@symfony/ux-live-component';

export default class extends Controller {
    async initialize() {
        const liveComponents = document.querySelectorAll("[data-controller='live']");

        liveComponents.forEach(async (element) => {
            const component = await getComponent(element);

            component.on("render:finished", this.replacePathname.bind(this, element));
        });
    }

    replacePathname(element) {
        if (element.dataset.url) {
            const currentUrl = new URL(window.location.href);
            const newUrl = new URL(element.dataset.url, currentUrl.origin);

            currentUrl.pathname = newUrl.pathname;

            history.replaceState({}, "", currentUrl.toString());
            console.log("Pathname replaced to:", currentUrl.pathname);
        }
    }

}
