describe("Success create portfolio", () => {
    it("success create portfolio", () => {
        cy.login("admin@customcraft.com", "admin123");
        cy.visit("https://ccqa.amirulikhsani.my.id/admin");

        cy.contains("a", "Portfolio").click();
        cy.contains("a", "New portfolio").click();
        cy.get("#data\\.name").type("Wooden Lamp");
        cy.get("#data\\.product_id").parents(".choices").click();
        cy.wait(500);
        cy.get(".choices__list--dropdown .choices__item--choice")
            .first()
            .click({ force: true });
        cy.wait(1000);
        cy.get("trix-editor").click().type("Deskripsi Portfolio");
        cy.get('input[type="file"]').attachFile("portfolios/9.jpeg");
        cy.get("#data\\.is_active").click();
        cy.wait(5000);
        cy.contains("button", "Create").click();
    });
});

describe("Reject photo that exceed 2MB", () => {
    it("reject photo that exceed 2MB", () => {
        cy.login("admin@customcraft.com", "admin123");
        cy.visit("https://ccqa.amirulikhsani.my.id/admin");

        cy.contains("a", "Portfolio").click();
        cy.contains("a", "New portfolio").click();
        cy.get("#data\\.name").type("Wooden Lamp exceed 2MB Photo");
        cy.get("#data\\.product_id").parents(".choices").click();
        cy.wait(500);
        cy.get(".choices__list--dropdown .choices__item--choice")
            .first()
            .click({ force: true });
        cy.wait(1000);
        cy.get("trix-editor").click().type("Deskripsi Portfolio");
        cy.get('input[type="file"]').attachFile("portfolios/morethan2MB.png");
    });
});

describe("Succes change portfolio status", () => {
    it("change portfolio status", () => {
        cy.login("admin@customcraft.com", "admin123");
        cy.visit("https://ccqa.amirulikhsani.my.id/admin");

        cy.contains("a", "Portfolio").click();
        cy.contains("a", "Wooden Lamp").click();
        cy.get('div[role="switch"]').first().click();
    });
});

describe("Success View portfolio", () => {
    it("view portfolio", () => {
        cy.login("admin@customcraft.com", "admin123");
        cy.visit("https://ccqa.amirulikhsani.my.id/admin");

        cy.contains("a", "Portfolio").click();
        cy.contains("a", "Wooden Lamp").click();
    });
});

describe("Succes Edit Portfolio", () => {
    it("edit portfolio", () => {
        cy.login("admin@customcraft.com", "admin123");
        cy.visit("https://ccqa.amirulikhsani.my.id/admin");

        cy.contains("a", "Portfolio").click();
        cy.contains("a", "Wooden Lamp").click();
        cy.contains("a", "Edit").click();

        cy.get("#data\\.name").clear().type("Wooden Lamp Updated");
        cy.get("trix-editor").click().type(" - Updated");
        cy.get(".filepond--action-remove-item")
            .should("be.visible")
            .click({ force: true });
        cy.wait(1000);
        cy.get('input[type="file"]').attachFile("portfolios/10.jpeg");
        cy.wait(5000);
        cy.contains("button", "Save changes").click();
    });
});

describe("Delete portfolio", () => {
    it("delete portfolio", () => {
        cy.login("admin@customcraft.com", "admin123");
        cy.visit("https://ccqa.amirulikhsani.my.id/admin");

        cy.contains("a", "Portfolio").click();
        cy.contains("a", "Wooden Lamp Updated").click();
        cy.contains("button", "Delete").click();
        cy.contains("button", "Confirm").click();
    });
});
