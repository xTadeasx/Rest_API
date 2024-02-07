Návod na API pro Dandu:
<table>	můžeš dát jakýkoliv table
<id>	můžeš dát jakékoliv id



GET:
  API/<tabulka>/<sloupec.seředit>	Dostaneš všechny věci v tabulce kterou jsi si určil a seřazené podle toho jak jsi si určil. (ASC/DESC)

 GET celé tabulky:
  API/workers/id.ASC 			Dostaneš tabulku workers sežřzenou od nejmenšího id až po největší 
  API/uzivatele/id.ASC 			Dostaneš tabulku uzivatele seřazenou od nejmenšího id až po největší 
  API/clanky/id.ASC 			Dostaneš tabulku clanky seřazenou od nejmenšího id až po největší 
  API/images/id.ASC 			Dostaneš tabulku images seřazenou od nejmenšího id až po největší 
  API/links/id.ASC 			Dostaneš tabulku links seřazenou od nejmenšího id až po největší
  API/kategorie/id.ASC			Dostaneš tabulku kategorie seřazenou od nejmenšího id až po největší
  API/dostupnost/id.ASC			Dostaneš tabulku links seřazenou od nejmenšího id až po největší

 GET řádek z tabulky:
  API/workers/id/1			Dostaneš řádek s id 1 z tabulky workers
  API/uzivatele/id/1			Dostaneš řádek s id 1 z tabulky uzivatele
  API/clanky/id/1			Dostaneš řádek s id 1 z tabulky clanky
  API/images/id/1			Dostaneš řádek s id 1 z tabulky images
  API/clanky/id/1			Dostaneš řádek s id 1 z tabulky links
  API/kategorie/id/1			Dostaneš řádek s id 1 z tabulky kategorie
  API/dostupnost/id/1			Dostaneš řádek s id 1 z tabulky dostupnost

POST:
  API/uzivatele/login			Pošleš údaje na přihlášení.['username, 'password'].

Pro všechno pod tímto textem POTŘEBA ODESLAT ['HTTP_AUTHORIZATION'] v headru jeho value dostaneš po přihlášení:

POST:
  Dostupnost(1,2):
    API/workers				Vytvoříš pracovníka je třeba poslat ['name','sur_name','title','job','phone_number','email'].
    API/uzivatele			Vytvoří uživatele je třeba ['username','password','name','sur_name', 'dostupnost'].
    API/clanky				Vytvoří clanek je třeba ['kategorie','name','sub_name','cas_konani'].
    API/images				Vytvoří obrázek je třeba ['file_name'].
    API/links				Vytvoří link je třeba ['link_name'].
    API/kategorie			Vytvoří kategorii je třeba ['name', 'sub_kategorie'].
  Dostupnost(3):
    API/clanky				Vytvoří clanek je třeba ['kategorie','name','sub_name','cas_konani'].
    API/images				Vytvoří obrázek je třeba ['file_name'].
    API/links				Vytvoří link je třeba ['link_name'].


PUT:
  // co se nepošle tak se nahraje znovu z databáze
  Dostupnost(1,2):
    API/workers/0/<id>			Update řádku v tabulce workers['name','sur_name','title','job','phone_number','email'].
    API/uzivatele/0/<id>		Update řádku v tabulce uzivatele['username','password','sur_name','dostupnost'].
    API/clanky/0/<id>			Update řádku v tabulce clanky['kategorie','name','sub_name','cas_konani','text'].
    API/images/0/<id>			Update řádku v tabulce images['file_name'].
    API/links/0/<id>			Update řádku v tabulce links['link_name'].
    API/kategorie/0/<id>		Update řádku v tabulce kategorie['link_name'].
  Dostupnost(3):
    API/clanky/0/<id>			Update řádku v tabulce clanky['kategorie','name','sub_name','cas_konani','text'].
    API/images/0/<id>			Update řádku v tabulce images['file_name'].
    API/links/0/<id>			Update řádku v tabulce links['name', 'sub_kategorie'].


DELETE:
  Dostupnost(1,2):
    API/workers/0/<id>			Deaktivuje pracovníka 
    API/uzivatele/0/<id>		Deaktivuje uzivatele
    API/clanky/0/<id>			Deaktivuje clanek
    API/kategorie/0/<id>		Deaktivuje kategorii 
    API/workers/1/<id>			Aktivuje pracovníka
    API/uzivatele/1/<id> 		Aktivuje uzivatele
    API/clanky/1/<id>			Aktivuje clanek
    API/kategorie/1/<id>		Aktivuje kategorii
  Dostupnost(3):
    API/clanky/0/<id>			Deaktivuje clanek 
    API/clanky/1/<id>			Aktivuje clanek 
API/(kategorie,dostupnost)		Je zakázáno to deaktivovat a aktivovat


to do list:
workers{	clanky{		uzivatele{	kategorie{	images{		links{		dostupnost{	Login 1
get	1	get	1	get	1	get	1	get	1	get	1	get	1	token 1
get/id	1	get/id	1	get/id	1	get/id	1	get/id	1	get/id	1	get/id	1	dostupnost 1
post	1	post	1	post	1	post	1	post	1	post	1	}
put	1	put	1	put	1	put	1	put	1	put	1
delete	1	delete	1	}		}		}		}
activate1	activate1				
}		}						




