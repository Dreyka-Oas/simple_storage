## 🗄️ Simple Storage Manager - Application CRUD PHP 🐘

Ce projet est une application web **PHP** simple conçue pour gérer des éléments de stockage (comme des outils), illustrant les opérations **CRUD** (Create, Read, Update, Delete) de base avec une base de données **PostgreSQL**.

---

### ✨ Fonctionnalités Clés :

*   **Gestion CRUD 📄:**
    *   **Ajouter (`add_element.php`):** Permet d'ajouter de nouveaux éléments avec nom, description, et association à un utilisateur/stockage via un formulaire.
    *   **Lister (`list.php`, `index.php`):** Affiche les éléments stockés dans un tableau paginé.
    *   **Modifier (`edit_element.php`, `edit_element_form.php`, `update_element.php`):** Permet de modifier les détails d'un élément existant.
    *   **Supprimer (`delete_element.php`, `remove_all.php`):** Permet de supprimer un élément spécifique ou de vider complètement la table des éléments et des utilisateurs.
*   **Affichage Paginé & Trié 📊:** La liste principale des éléments supporte la pagination pour gérer un grand nombre d'entrées et le tri par colonne (Nom, Description, Numéro de Stockage, Utilisateur) en cliquant sur les en-têtes de tableau.
*   **Recherche Avancée 🔍:** Fonctionnalité de recherche permettant de filtrer les éléments par colonne (Nom, Description, Numéro de Stockage) avec une option pour une recherche exacte ou partielle (LIKE).
*   **Génération de Données (Faker) ✨:** Utilise la librairie `FakerPHP` pour peupler rapidement la base de données avec des données d'exemple (outils et utilisateurs) à partir d'un fichier JSON (`tools_faker.json`).
*   **Interface Utilisateur (Bootstrap) 🎨:** Utilise le thème "Cyborg" de Bootswatch (Bootstrap 4) pour une interface utilisateur sombre et fonctionnelle.
*   **Configuration Externe ⚙️:** Les informations de connexion à la base de données PostgreSQL sont gérées dans un fichier `conf_connect.json` séparé.
*   **Structure Simple MVC-like 🏗️:** Organisation basique avec un contrôleur (`HomeController.php`), des vues (`main.php`, `edit_element_form.php`), des scripts d'action (dans `/controller`), des fonctions utilitaires (dans `/functions`), et une classe de connexion à la BDD (`connect.php`).

---

### 🚀 Technologies Utilisées :

*   **Backend:** PHP 🐘
*   **Base de Données:** PostgreSQL 🐘
*   **Frontend:** HTML, Bootstrap 4 (Bootswatch Cyborg Theme) 🎨
*   **Librairie PHP:** FakerPHP (pour la génération de données) ✨

---

Ce projet sert d'exemple pratique pour la mise en œuvre d'une application web CRUD complète en PHP avec une base de données PostgreSQL, incluant des fonctionnalités courantes comme la pagination, le tri, la recherche et la génération de données de test.
