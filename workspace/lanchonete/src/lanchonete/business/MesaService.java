package lanchonete.business;

import java.util.ArrayList;
import java.util.List;

import lanchonete.DAO.MesaDao;
import lanchonete.model.MesaModel;
import lanchonete.view.MesaView;


public class MesaService {
	
	public void listarmesa(){
		MesaDao dao = new MesaDao();
		try{
			List<MesaModel> lista = dao.listarMesas();
			if(!lista.isEmpty()){
				MesaView mesaView = new MesaView();
				mesaView.listarMesa(lista);
			}
		}catch (Exception e) {
			e.printStackTrace();
		}
	}

	public List<MesaModel> getMesa(int cod_mesa) {
		MesaDao dao = new MesaDao();
		List<MesaModel> lista = new ArrayList<>();
		try {
			MesaModel m = dao.getMesa(cod_mesa);
			if (m.getCod_mesa() != 0) {
				lista.add(m);
			}

		} catch (Exception e) {
			e.printStackTrace();
		}
		return lista;
	}
	
	public int cadastrarMesa(MesaModel mesaCad) {
		MesaDao dao = new MesaDao();
		int retorno = 0;
		try {
			retorno = dao.cadastrarMesa(mesaCad);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public int excluirMesa(int cod_mesa) {
		MesaDao dao = new MesaDao();
		int retorno = 0;
		try {
			retorno = dao.deletarMesa(cod_mesa);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public int editarMesa(MesaModel m) {
		MesaDao dao = new MesaDao();
		int retorno = 0;
		try {
			retorno = dao.updateMesa(m);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}}
	
