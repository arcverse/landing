import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [ "navbarDiv" ]
    openNav() {
        this.navbarDivTarget.classList.remove("hidden");
        this.navbarDivTarget.classList.add("flex");
    }
    closeNav() {
        this.navbarDivTarget.classList.remove("flex");
        this.navbarDivTarget.classList.add("hidden");
    }
}
