# AI Text Detector

## Présentation

AI Text Detector est une application Web qui permet aux utilisateurs de détecter du texte généré par l'IA à partir de diverses sources. Elle prend en charge les téléchargements de fichiers PDF et l'authentification des Utilisateurs. L'application est conçue avec Laravel (backend) et React (frontend) en utilisant MySQL pour le stockage des données.

## Fonctionnalités

### **Fonctionnalités principales**
- **Détection de texte générée par l'IA**: analysez le texte saisi pour déterminer s'il est généré par l'IA.
- **Utilisation limitée gratuite**: les nouveaux utilisateurs peuvent tester la fonction de détection de l'IA n'importe quelle fois mais pour scanner des Pdf l'authentification sera requise.
- **Importer PDF**:
  - Upload PDF files containing text for AI analysis.
  - Téléchargez des fichiers PDF contenant du texte pour une analyse par l'IA.
  - Extraire du texte à partir de PDF à l'aide de **smalot/pdfparser** dans Laravel.

- **Authentification et gestion des utilisateurs :**:

  - Connexion et inscription sécurisées.
  - Contrôle d'accès basé sur les rôles pour les utilisateurs et les administrateurs.

### **Frontend (React)** 
- **React Router DOM** pour la navigation.
- **Tailwind CSS** pour la conception des interfaces.
- **Système de téléchargement de fichiers** utilisand `useForm` de `react-hook-form` et `axios`.
- **Traitement PDF**:
  - Téléchargez des fichiers PDF et envoyez-les au backend.
  - Affichez le texte extrait et autorisez l'exportation des résultats.

### **Backend (Laravel)**
- **API Routes dans `api.php`** pour gérer les requêtes.
- **MySQL Base De Donee** pour stockage des donnee.
- **PDF Text Extraction** a l'aide du package `smalot/pdfparser`.
- **Algorithme de détection de texte IA** (l'intégration avec l'API OpenAI gpt-3.5-turbo).

## Exigences du projet  
Ce projet respecte les critères demandés:  

- [x] **Au moins 3 contrôleurs**, ce projet contien 4 controlleurs: textController,UserController,PdfController,RoleController.  
- [x] **Base de données** avec :  
  - Une relation **1,n**, est la relation entre User et Text dans la base de donnes
  - Une relation **n,n**, gérées au niveau des modèles.  
- [x] **Middleware** personnalisé appliqué sur une route ou un contrôleur.  
- [x] **Validation des formulaires** côté back-end.  
- [x] **Gestion des vues avec Blade** (optionnel : Vue.js ou React en complément).  
- [x] **Dashboard avec un bouton de génération de rapport en PDF**.  
- [x] **Bouton d'importation/exportation de fichiers Excel (.xls / .csv) sur une page index**.  
- [x] **Système d'authentification** (mentionné dans la documentation).  
- [x] **Test unitaire** sur au moins un contrôleur.  

### Execution**

## **Page d'accueil**
![Home Page](./screens/home.jpg)

## **Page Detection Text IA**
![Check Text Page](./screens/check-1.jpg)

## **Page Detection Text IA**
![Check Text Page](./screens/check-2.jpg)

## **Page Detection Text IA**
![Check Text Page](./screens/check-3.jpg)

## **Page Authentification : Login**
![Authentication Page](./screens/login-1.jpg)

## **Page Authentification : apres saisir les infos**
![Authentication Page](./screens/login-2.jpg)

## **Page Authentification : Register**
![Authentication Page](./screens/register.jpg)

## **Page Scan Pdf**
![PDF Scan Page](./screens/scan-1.jpg)

## **Page Scan Pdf apres telecharger fichier**
![PDF Scan Page](./screens/scan-3.jpg)

## **Page Scan Pdf**
![PDF Scan Page](./screens/scan-2.jpg)

## Contributors
- **Ameur**
