drop table BossReward;
drop table BossLocation;
drop table BossCost;
drop table MaterialReward;
drop table ArtifactRecommendation;
drop table WeaponRecommendation;
drop table Need;
drop table Character;
drop table Material;
drop table NoRewardMission;
drop table RewardedMission;
drop table Mission;
drop table WeaponStatus;
drop table WeaponRefinement;
drop table WeaponLevel;
drop table Weapon;
drop table Country;
drop table CharacterLevel;
drop table SandOfEon;
drop table GobletOfEonthem;
drop table CircletOfLogos;
drop table FlowerOfLife;
drop table PlumeOfDeath;
drop table Artifact;



create table BossCost(
	BossType	CHAR(100),	
	Cost		INTEGER,
	PRIMARY KEY (BossType));

create table Material(
	MaterialName		CHAR(500),
	Description		CHAR(1000),
	PRIMARY KEY (MaterialName));

create table Mission(
	MissionName	CHAR(500),
	Task		CHAR(500),
	PRIMARY KEY(MissionName));

create table Weapon(
	Name	CHAR(500),
	Description	CHAR(1000) UNIQUE,
	AscendRank	INTEGER,
	PRIMARY KEY (Name));

create table WeaponLevel(
	AscendRank	INTEGER,
	MaxLevel	INTEGER,
	PRIMARY KEY (AscendRank));

create table WeaponRefinement(
	RefinementRank	INTEGER,
	PassiveAbility		CHAR(500),
	BaseATK		INTEGER,
	PRIMARY KEY (RefinementRank));


create table Country(
	Name		CHAR(100),
	PRIMARY KEY (Name));


create table CharacterLevel(
	AscendRank	INTEGER,
	MaxLevel	INTEGER,
	PRIMARY KEY (AscendRank));


create table Artifact(
	Name		CHAR(500),
	Story		CHAR(1000),
	Description	CHAR(1000),
	PRIMARY KEY (Name));
	


create table BossLocation(
	BossName	CHAR(500),
	BossType	CHAR(100),
	Description	CHAR(1000),
	CountryName	CHAR(100) NOT NULL,
	HP		INTEGER,
	PRIMARY KEY (BossName),
	UNIQUE (HP, BossType),
	FOREIGN KEY (CountryName) REFERENCES Country(Name)
	ON DELETE SET NULL,
	FOREIGN KEY (BossType) REFERENCES BossCost(BossType)
	ON DELETE CASCADE);

create table BossReward(
	BossName	CHAR(500),
	MaterialName CHAR(500),
	PRIMARY KEY (BossName, MaterialName),
	FOREIGN KEY (BossName) REFERENCES BossLocation(BossName)
	ON DELETE CASCADE,
	FOREIGN KEY (MaterialName) REFERENCES Material(MaterialName)
	ON DELETE CASCADE);


create table Character(
	Name		CHAR(500),
	Story		CHAR(1000) UNIQUE,
	Description	CHAR(1000),
	CountryName	CHAR(100) NOT NULL,
	MissionName 	CHAR(500),
	AscendRank	INTEGER,
	PRIMARY KEY (Name),
	FOREIGN KEY (CountryName) REFERENCES Country(Name)
	ON DELETE SET NULL,
	FOREIGN KEY (MissionName) REFERENCES Mission
	ON DELETE SET NULL);


create table MaterialReward(
	MaterialName	CHAR(500),
	MissionName	CHAR(500),
	PRIMARY KEY (MaterialName, MissionName),
	FOREIGN KEY (MaterialName) REFERENCES Material
	ON DELETE CASCADE,
	FOREIGN KEY (MissionName) REFERENCES Mission
	ON DELETE CASCADE);


create table ArtifactRecommendation(
	ArtifactName		CHAR(500),
	CharacterName	CHAR(500),
	PRIMARY KEY (ArtifactName, CharacterName),
	FOREIGN KEY (ArtifactName) REFERENCES Artifact(Name)
	ON DELETE CASCADE,
	FOREIGN KEY (CharacterName) REFERENCES Character(Name)
	ON DELETE CASCADE);


create table WeaponRecommendation(
	Name		CHAR(500),
	CharacterName	CHAR(500),
	PRIMARY KEY (Name, CharacterName),
	FOREIGN KEY (Name) REFERENCES Weapon(Name)
	ON DELETE CASCADE,
	FOREIGN KEY (CharacterName) REFERENCES Character(Name)
	ON DELETE CASCADE);

create table Need(
	CharName	CHAR(500),
	MaterialName CHAR(500),
	PRIMARY KEY (CharName, MaterialName),
	FOREIGN KEY (CharName) REFERENCES Character(Name)
	ON DELETE CASCADE,
	FOREIGN KEY (MaterialName) REFERENCES Material
	ON DELETE CASCADE);


create table NoRewardMission(
	MissionName	CHAR(500),
	Description	CHAR(1000),
	PRIMARY KEY (MissionName),
	FOREIGN KEY (MissionName) REFERENCES Mission
	ON DELETE CASCADE);


create table RewardedMission(
	MissionName	CHAR(500),
	PRIMARY KEY (MissionName),
	FOREIGN KEY (MissionName) REFERENCES Mission
	ON DELETE CASCADE);


create table WeaponStatus(
	Name		CHAR(500) NOT NULL,
	RefinementRank	INTEGER,
	Rarity			INTEGER,
	PRIMARY KEY (Name, RefinementRank),
	FOREIGN KEY (Name) REFERENCES Weapon
	ON DELETE CASCADE,
	FOREIGN KEY (RefinementRank) REFERENCES WeaponRefinement
	ON DELETE CASCADE);


create table PlumeOfDeath(
	Name		CHAR(500),
	ATK		INTEGER,
	PRIMARY KEY (Name),
	FOREIGN KEY (Name) REFERENCES Artifact
	ON DELETE CASCADE);


create table SandOfEon(
	Name		CHAR(500),
	RandomEffect CHAR(500),
	PRIMARY KEY (Name),
	FOREIGN KEY (Name) REFERENCES Artifact
	ON DELETE CASCADE);


create table GobletOfEonthem(
	Name		CHAR(500),
	RandomEffect CHAR(500),
	PRIMARY KEY (Name),
	FOREIGN KEY (Name) REFERENCES Artifact
	ON DELETE CASCADE);


create table CircletOfLogos(
	Name		CHAR(500),
	RandomEffect CHAR(500),
	PRIMARY KEY (Name),
	FOREIGN KEY (Name) REFERENCES Artifact
	ON DELETE CASCADE);


create table FlowerOfLife(
	Name		CHAR(500),
	HP		INTEGER,
	PRIMARY KEY (Name),
	FOREIGN KEY (Name) REFERENCES Artifact
	ON DELETE CASCADE);



grant select on BossCost to public;
grant select on BossLocation to public;
grant select on Material to public;
grant select on BossReward to public;
grant select on Need to public;
grant select on Mission to public;
grant select on NoRewardMission to public;
grant select on RewardedMission to public;
grant select on MaterialReward to public;
grant select on Weapon to public;
grant select on WeaponLevel to public;
grant select on WeaponStatus to public;
grant select on WeaponRefinement to public;
grant select on Country to public;
grant select on Character to public;
grant select on CharacterLevel to public;
grant select on Artifact to public;
grant select on FlowerOfLife to public;
grant select on PlumeOfDeath to public;
grant select on SandOfEon to public;
grant select on GobletOfEonthem to public;
grant select on CircletOfLogos to public;
grant select on ArtifactRecommendation to public;
grant select on WeaponRecommendation to public;


 



INSERT INTO BossCost
VALUES('Geovishap', 40);
INSERT INTO BossCost
VALUES('Hypostasis',40);
INSERT INTO BossCost
VALUES('Regisvine', 40);


INSERT INTO Material
VALUES('Vajrada Amethyst', 'Vajrada Amethyst Fragment is a Character Ascension Material used by Electro characters');
INSERT INTO Material
VALUES('Prithiva Topaz', 'Prithiva Topaz Sliver is a Character Ascension Material used by Geo characters.');
INSERT INTO Material
VALUES('Agnidus Agate', 'It is said that there was a great tree whose roots once spread out to every corner of the world, and this branch is said to be part of it.');
INSERT INTO Material
VALUES('Shivada Jade', 'Shivada Jade Sliver is a Character Ascension Material used by Cryo characters.');
INSERT INTO Material
VALUES('Varunada Lazurite' , 'Varunada Lazurite Fragment is a Character Ascension Material used by Hydro characters.');




INSERT INTO Mission
VALUES('Outlander in the wind', 'Birds eye view');
INSERT INTO Mission
VALUES('For a tomorrow without tears', 'Shadow over mondstadt');
INSERT INTO Mission
VALUES('Song of dragon and freedom', ' Abyss mage');
INSERT INTO Mission
VALUES('Of the Land Amidst Monoliths', 'Rite of Descension');
INSERT INTO Mission
VALUES('Papilio Charonits', 'Mysterious Wangsheng Parlour');
INSERT INTO Mission
VALUES('A Long Shot', 'Defeat Dvalin');
INSERT INTO Mission
VALUES('Wind, Courage and wings', 'use wind glinder');


 
INSERT INTO Weapon
VALUES(
'Skyward Spine',
'A polearm that symbolizes Dvalins fire resolve. ',
5
);
INSERT INTO Weapon
VALUES(
'Staff of Homa',
'A "firewood staff" that was once used in ancient and long-lost rituals.',
5
);
INSERT INTO Weapon
VALUES(
'Skyward Atlas',
'A cloud atlas symbolizing Dvalin and its former master, the Anemo Archon.',
4
);
INSERT INTO Weapon
VALUES(
'Skyward Blade',
'The sword of a knight that symbolizes the restored honor of Dvalin.',
4
);
INSERT INTO Weapon
VALUES(
'Wolfs Gravestone',
'A longsword used by the Wolf Knight.',
4
);


  
INSERT INTO WeaponLevel
VALUES(1, 40);
INSERT INTO WeaponLevel
VALUES(2, 50);
INSERT INTO WeaponLevel
VALUES(3, 60);
INSERT INTO WeaponLevel
VALUES(4, 70);
INSERT INTO WeaponLevel
VALUES(5, 80);
INSERT INTO WeaponLevel
VALUES(6, 90);
 

INSERT INTO WeaponRefinement
VALUES(1, 'elemental damage', 12);
INSERT INTO WeaponRefinement
VALUES(2, 'elemental burst', 15);
INSERT INTO WeaponRefinement
VALUES(3, 'none', 18);
INSERT INTO WeaponRefinement
VALUES(4, 'none', 21);
INSERT INTO WeaponRefinement
VALUES(5, 'none', 24);


INSERT INTO Country
VALUES('Liyue');
INSERT INTO Country
VALUES('Mondstadt');
INSERT INTO Country
VALUES('Inazuma');
INSERT INTO Country
VALUES('Sumeru');
INSERT INTO Country
VALUES('Snezhnaya');


INSERT INTO CharacterLevel
VALUES(1, 20);
INSERT INTO CharacterLevel
VALUES(2, 40);
INSERT INTO CharacterLevel
VALUES(3, 50);
INSERT INTO CharacterLevel
VALUES(4, 60);
INSERT INTO CharacterLevel
VALUES(5, 70);
INSERT INTO CharacterLevel
VALUES(6, 80);
INSERT INTO CharacterLevel
VALUES(7, 90);



INSERT INTO Artifact
VALUES (
   'Gladiators nostalgia',
   'He made a brooch with it and pinned it on the gladiators chest, it came to symbolize his gentler side.',
   'An ordinary flower picked gently by the gladiators master.'
);
INSERT INTO Artifact
VALUES (
	'Gladiators Destiny',
	'A feather of dreams that soars free like an eagle.',
	'A feather of dreams that soars free like an eagle.'
);
INSERT INTO Artifact
VALUES (
   'Gladiators Intoxication',
   'The golden cup a champion gladiator drank from in ancient times.',
   'The golden cup a champion gladiator drank from in ancient times.'
);
INSERT INTO Artifact
VALUES (
   'Gladiators Triumphus',
   'The helmet of a legendary gladiator from ancient times ',
   'The helmet of a legendary gladiator from ancient times '
);

INSERT INTO Artifact
VALUES (
   'Witches end Time',
   'The years the witch dedicated to the flames flow within.',
   'A timepiece worn by the witch who dreamt of burning away all the demons in the world.'
);






INSERT INTO BossLocation
VALUES('Primo Geovishap', 
'Geovishap', 
'The Primo Geovishap is a Normal Boss in Genshin Impact and a larger version of the mature Geovishap.',
'Liyue',
8000);
INSERT INTO BossLocation
VALUES('Electro Hypostasis', 
'Hypostasis', 
'The Electro Hypostasis is a Normal Boss in Genshin Impact and one of the elemental Hypostases.',
'Mondstadt',
8001);
INSERT INTO BossLocation
VALUES('Geo Hypostasis', 
'Hypostasis', 
'Geo Hypostasis is a Normal Boss in Genshin Impact and one of the elemental Hypostases.',
'Liyue',
8010);
INSERT INTO BossLocation
VALUES('Pyro Regisvine', 'Regisvine', 
'The Pyro Regisvine is a Normal Boss in Genshin Impact and one of the Regisvines.',
'Liyue',
8031);
INSERT INTO BossLocation
VALUES('Cryo Regisvine', 
'Regisvine', 
'The Cryo Regisvine is a Normal Boss in Genshin Impact and one of the Regisvines.',
'Liyue',
8012);



INSERT INTO BossReward
VALUES('Primo Geovishap', 'Varunada Lazurite');
INSERT INTO BossReward
VALUES('Electro Hypostasis', 'Vajrada Amethyst');
INSERT INTO BossReward
VALUES('Geo Hypostasis', 'Prithiva Topaz');
INSERT INTO BossReward
VALUES('Pyro Regisvine','Agnidus Agate');
INSERT INTO BossReward
VALUES('Cryo Regisvine','Shivada Jade');



INSERT INTO Character
VALUES('Hutao',
'She does her utmost to flawlessly carry out a persons last rites and preserve the worlds balance of yin and yang.',
'She is the 77th Director of the Wangsheng Funeral Parlor.',
'Liyue',
'Papilio Charonits',
5
);
INSERT INTO Character
VALUES('Barbara',
'She is the deaconess of the Church of Favonius and a self-proclaimed idol after learning about them from the intrepid adventurer Alice.',
'She is also the daughter of Frederica Gunnhildr and Seamus Pegg, and the younger sister of Jean.',
'Mondstadt',
'A Long Shot',
4
);
INSERT INTO Character
VALUES(
   'Amber',
   'As the only remaining Outrider of the Knights of Favonius, she is always ready to help the citizens of Mondstadt — whether it be something simple or perhaps a more challenging task.',
   'As the only remaining Outrider of the Knights of Favonius, she is always ready to help the citizens of Mondstadt — whether it be something simple or perhaps a more challenging task.',
   'Mondstadt',
   'Wind, Courage and wings',
   4
);
INSERT INTO Character
VALUES(
   'Kamisato Ayaka',
   'Because of her social status as the eldest daughter of the Kamisato Clan of the Yashiro Commission and as the Shirasagi Himegimi, Ayaka is seen as a model of perfection.',
   'She is the eldest daughter of the Kamisato Clan and sister of Kamisato Ayato.Being beautiful, elegant, and graceful, the common-folk have nothing to bad-mouth Ayaka about.',
   'Inazuma',
   'Outlander in the wind',
   5
);
INSERT INTO Character
VALUES(
   'Ningguang',
   'She is the Tianquan of the Liyue Qixing and owns the floating Jade Chamber in the skies of Liyue.',
   'She is the Tianquan of the Liyue Qixing and owns the floating Jade Chamber in the skies of Liyue.',
   'Liyue',
   'Of the Land Amidst Monoliths',
   4
);
 
 


  
INSERT INTO MaterialReward
VALUES('Varunada Lazurite', 'Of the Land Amidst Monoliths');
INSERT INTO MaterialReward
VALUES('Vajrada Amethyst', 'A Long Shot');
INSERT INTO MaterialReward
VALUES('Prithiva Topaz', 'Outlander in the wind');
INSERT INTO MaterialReward
VALUES('Agnidus Agate', 'For a tomorrow without tears');
INSERT INTO MaterialReward
VALUES('Shivada Jade', 'Song of dragon and freedom');
 


INSERT INTO ArtifactRecommendation
VALUES('Gladiators Intoxication', 'Ningguang');
INSERT INTO ArtifactRecommendation
VALUES('Witches end Time', 'Barbara');
INSERT INTO ArtifactRecommendation
VALUES('Gladiators Triumphus', 'Amber');
INSERT INTO ArtifactRecommendation
VALUES('Gladiators Destiny', 'Hutao');
INSERT INTO ArtifactRecommendation
VALUES('Gladiators nostalgia', 'Hutao');
INSERT INTO ArtifactRecommendation
VALUES('Gladiators Intoxication', 'Hutao');
INSERT INTO ArtifactRecommendation
VALUES('Gladiators Triumphus', 'Hutao');
INSERT INTO ArtifactRecommendation
VALUES('Witches end Time', 'Hutao');
INSERT INTO ArtifactRecommendation
VALUES('Gladiators nostalgia', 'Kamisato Ayaka');


 
INSERT INTO WeaponRecommendation
VALUES('Skyward Atlas', 'Ningguang' );
INSERT INTO WeaponRecommendation
VALUES('Staff of Homa', 'Hutao');
INSERT INTO WeaponRecommendation
VALUES('Skyward Atlas', 'Barbara');
INSERT INTO WeaponRecommendation
VALUES('Skyward Blade', 'Kamisato Ayaka');
INSERT INTO WeaponRecommendation
VALUES('Wolfs Gravestone', 'Amber');
 


INSERT INTO Need
VALUES('Ningguang','Prithiva Topaz');
INSERT INTO Need
VALUES('Amber', 'Agnidus Agate');
INSERT INTO Need
VALUES('Kamisato Ayaka', 'Shivada Jade');
INSERT INTO Need
VALUES('Barbara', 'Varunada Lazurite');
INSERT INTO Need
VALUES('Hutao', 'Agnidus Agate');
 
 

 



INSERT INTO NoRewardMission
VALUES('Wind, Courage and wings', 'use wind glinder');
INSERT INTO NoRewardMission
VALUES('Papilio Charonits', 'Butterfly Flutters away');

 

 

INSERT INTO RewardedMission
VALUES('Outlander in the wind');
INSERT INTO RewardedMission
VALUES('For a tomorrow without tears');
INSERT INTO RewardedMission
VALUES('Song of dragon and freedom');
INSERT INTO RewardedMission
VALUES('Of the Land Amidst Monoliths');
INSERT INTO RewardedMission
VALUES('A Long Shot');
 
 

INSERT INTO WeaponStatus
VALUES('Skyward Spine', 5, 5);
INSERT INTO WeaponStatus
VALUES('Staff of Homa', 5, 5);
INSERT INTO WeaponStatus
VALUES('Skyward Atlas', 5, 5);
INSERT INTO WeaponStatus
VALUES('Skyward Blade', 5,5 );
INSERT INTO WeaponStatus
VALUES('Wolfs Gravestone', 5, 5);
 

 
INSERT INTO FlowerOfLife
VALUES ('Gladiators nostalgia' ,4780);

 
INSERT INTO PlumeOfDeath
VALUES ('Gladiators Destiny', 311);


 
INSERT INTO SandOfEon
VALUES('Witches end Time','HP');

 
 
INSERT INTO GobletOfEonthem
VALUES ('Gladiators Intoxication', 'Crit Rate');

 
INSERT INTO  CircletOfLogos
VALUES ('Gladiators Triumphus','Crit Rate');


