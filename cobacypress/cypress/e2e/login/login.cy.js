describe("Login Success", () => {
    it("login success", () => {
        cy.visit("https://ccqa.amirulikhsani.my.id/admin/login");
        cy.get('input[type="email"]').type("admin@customcraft.com");
        cy.get('input[type="password"]').type("admin123");
        cy.get('input[type="checkbox"]').check();

        cy.get('button[type="submit"]').click();
    });
});

describe("Wrong Password", () => {
    it("login failed because wrong password", () => {
        cy.visit("https://ccqa.amirulikhsani.my.id/admin/login");
        cy.get('input[type="email"]').type("admin@customcraft.com");
        cy.get('input[type="password"]').type("wrongpassword");
        cy.get('input[type="checkbox"]').check();

        cy.get('button[type="submit"]').click();
    });
});

describe("unregistered Email", () => {
    it("login failed because unregistered email", () => {
        cy.visit("https://ccqa.amirulikhsani.my.id/admin/login");
        cy.get('input[type="email"]').type("unregistered@customcraft");
        cy.get('input[type="password"]').type("wrongpassword");
        cy.get('input[type="checkbox"]').check();

        cy.get('button[type="submit"]').click();
    });
});
