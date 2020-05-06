/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de creation :  06/05/2020 18:23:27                      */
/*==============================================================*/


drop table if exists Categorie;

drop table if exists Commande;

drop table if exists LigneCommande;

drop table if exists LignePanier;

drop table if exists Produit;

drop table if exists Users;

/*==============================================================*/
/* Table : Categorie                                            */
/*==============================================================*/
create table Categorie
(
   idCategorie          int not null,
   nomCategorie         varchar(254) not null,
   primary key (idCategorie)
);

/*==============================================================*/
/* Table : Commande                                             */
/*==============================================================*/
create table Commande
(
   idCommande           int not null,
   idUser               int,
   dateCommande         datetime not null,
   PrixUT               float not null,
   etat_commande        varchar(254),
   primary key (idCommande)
);

/*==============================================================*/
/* Table : LigneCommande                                        */
/*==============================================================*/
create table LigneCommande
(
   idProduit            int not null,
   idCommande           int not null,
   qteLigneCommande     int not null,
   primary key (idProduit, idCommande)
);

/*==============================================================*/
/* Table : LignePanier                                          */
/*==============================================================*/
create table LignePanier
(
   idProduit            int not null,
   idUser               int not null,
   qteLignePanier       int not null,
   primary key (idProduit, idUser)
);

/*==============================================================*/
/* Table : Produit                                              */
/*==============================================================*/
create table Produit
(
   idProduit            int not null,
   idCategorie          int,
   nomProdui            varchar(254) not null,
   prix                 float not null,
   quantiteStock        int not null,
   imageProduit         bigint not null,
   produtit_panier_standard bool,
   qte_ligne_panier_standard int,
   primary key (idProduit)
);

/*==============================================================*/
/* Table : User                                                 */
/*==============================================================*/
create table Users
(
   idUser               int not null,
   nom                  varchar(254) not null,
   prenom               varchar(254) not null,
   email                varchar(254) not null,
   password             varchar(254) not null,
   type                 varchar(254),
   primary key (idUser)
);

alter table Commande add constraint FK_Association_1 foreign key (idUser)
      references Users (idUser) on delete restrict on update restrict;

alter table LigneCommande add constraint FK_Association_5 foreign key (idCommande)
      references Commande (idCommande) on delete restrict on update restrict;

alter table LigneCommande add constraint FK_Association_5 foreign key (idProduit)
      references Produit (idProduit) on delete restrict on update restrict;

alter table LignePanier add constraint FK_Association_4 foreign key (idProduit)
      references Produit (idProduit) on delete restrict on update restrict;

alter table LignePanier add constraint FK_Association_4 foreign key (idUser)
      references Users (idUser) on delete restrict on update restrict;

alter table Produit add constraint FK_Association_2 foreign key (idCategorie)
      references Categorie (idCategorie) on delete restrict on update restrict;

