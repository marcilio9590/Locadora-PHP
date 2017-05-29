package lanchonete.view;

import java.util.List;

import lanchonete.model.MesaModel;

public class MesaView {
	
	public void listarMesa(List<MesaModel> lista) {
		System.out.println(
				"---------------------------------------- Lista das Mesas -------------------------------------");
		if(!lista.isEmpty()) {
			for (int i = 0; i < lista.size(); i++) {
				System.out.println("Numero da Mesa: " + lista.get(i).getCod_mesa());
				System.out.println("Status: " + lista.get(i).getStatus());
				if (i != lista.size() - 1) {
					System.out.println(
							"------------------------------------------------------------------------------------------------");
				}
			}
		} else {
			System.out.println("Nenhuma mesa encontrada.");
		}
		System.out.println(
				"------------------------------------------------------------------------------------------------");

	}

}
